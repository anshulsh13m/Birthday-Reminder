<?php

namespace Ansh\BirthdayReminder\Cron;

use Magento\Customer\Model\CustomerFactory;
use Magento\Framework\Mail\Template\TransportBuilder;
use Ansh\BirthdayReminder\Model\BirthdayReminderFactory;
use Magento\Framework\App\Config\ScopeConfigInterface;

class BirthdayReminder
{
    /**
     * @var CustomerFactory
     */
    protected $_customerFactory;

    /**
     * @var TransportBuilder
     */
    protected $_transportBuilder;

    /**
     * @var BirthdayReminderFactory
     */
    protected $_birthdayReminderFactory;

    /**
     * @var ScopeConfigInterface
     */
    protected $_scopeConfig;

    /**
     * BirthdayReminder constructor.
     * @param CustomerFactory $customerFactory
     * @param TransportBuilder $transportBuilder
     * @param BirthdayReminderFactory $birthdayReminderFactory
     */
    public function __construct(
        CustomerFactory $customerFactory,
        TransportBuilder $transportBuilder,
        BirthdayReminderFactory $birthdayReminderFactory,
        ScopeConfigInterface $scopeConfig
    ) {
        $this->_customerFactory = $customerFactory;
        $this->_transportBuilder = $transportBuilder;
        $this->_birthdayReminderFactory = $birthdayReminderFactory;
        $this->_scopeConfig = $scopeConfig;
    }

    /**
     * Check the customer birthday date
     */
    public function execute()
    {
        $daymonthNow = date( 'd' ) . '-' . date( 'm' );
        $collection = $this->_customerFactory->create()->getCollection()
            ->addAttributeToSelect( "*" )
            ->addFieldToFilter("dob", array('notnull' => false));

        // Delete all records before insert Records
        $model = $this->_birthdayReminderFactory->create()->getCollection();
        $model->walk('delete');

        foreach ($collection as $customer) {
            $dob = explode(' ', $customer->getDob());
            $date = explode( '-', $dob[0] );
            $daymonthBirthday = $date[2] . '-' . $date[1];

            if ($daymonthBirthday == $daymonthNow) {
                $customerName = mb_convert_case( $customer->getFirstname(), MB_CASE_TITLE, "UTF-8" );
                $customerId = $customer->getId();
                $customerEmail = $customer->getEmail();
                $customerDob = $customer->getDob();

                // Insert Record of customer birthday data
                $birthdayModel = $this->_birthdayReminderFactory->create();
                $birthdayModel->setCustomerId($customerId);
                $birthdayModel->setEmail($customerEmail);
                $birthdayModel->setDob($customerDob);
                $birthdayModel->save();

                $report = [
                    'Customer_name' => $customerName
                ];
                $postObject = new \Magento\Framework\DataObject();
                $postObject->setData( $report );

                $value = $this->_scopeConfig->getValue('general/general/reminder_setting');
                if (isset($value)) {
                    $this->_sendBirthdayEmail($customerEmail, $customerName, $postObject);
                }
            }
        }
    }

    /**
     * @param $customerName
     * @param $customerEmail
     * @param $postObject
     * @return $this
     */
    protected function _sendBirthdayEmail($customerName,$customerEmail,$postObject)
    {
        $senderName = $this->_scopeConfig->getValue('general/general/send_name');
        $senderEmail = $this->_scopeConfig->getValue('general/general/send_email');

        $transport = $this->_transportBuilder
            ->setTemplateIdentifier('birthday_reminder_email')
            ->setTemplateOptions(['area' => \Magento\Framework\App\Area::AREA_FRONTEND, 'store' => \Magento\Store\Model\Store::DEFAULT_STORE_ID])
            ->setTemplateVars(['data' => $postObject])
            ->setFrom(['name' => $senderName,'email' => $senderEmail])
            ->addTo($customerEmail)
            ->getTransport();
        $transport->sendMessage();

        return $this;
    }
}


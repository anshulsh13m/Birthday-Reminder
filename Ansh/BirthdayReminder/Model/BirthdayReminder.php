<?php

namespace Ansh\BirthdayReminder\Model;

use Magento\Framework\Api\DataObjectHelper;
use Ansh\BirthdayReminder\Api\Data\BirthdayReminderInterface;
use Ansh\BirthdayReminder\Api\Data\BirthdayReminderInterfaceFactory;

class BirthdayReminder extends \Magento\Framework\Model\AbstractModel
{
    /**
     * @var BirthdayReminderInterfaceFactory
     */
    protected $birthdayreminderDataFactory;

    /**
     * @var string
     */
    protected $_eventPrefix = 'ansh_birthdayreminder_birthdayreminder';

    /**
     * @var DataObjectHelper
     */
    protected $dataObjectHelper;

    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param BirthdayReminderInterfaceFactory $birthdayreminderDataFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param \Ansh\BirthdayReminder\Model\ResourceModel\BirthdayReminder $resource
     * @param \Ansh\BirthdayReminder\Model\ResourceModel\BirthdayReminder\Collection $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        BirthdayReminderInterfaceFactory $birthdayreminderDataFactory,
        DataObjectHelper $dataObjectHelper,
        \Ansh\BirthdayReminder\Model\ResourceModel\BirthdayReminder $resource,
        \Ansh\BirthdayReminder\Model\ResourceModel\BirthdayReminder\Collection $resourceCollection,
        array $data = []
    ) {
        $this->birthdayreminderDataFactory = $birthdayreminderDataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * Retrieve birthdayreminder model with birthdayreminder data
     * @return BirthdayReminderInterface
     */
    public function getDataModel()
    {
        $birthdayreminderData = $this->getData();
        
        $birthdayreminderDataObject = $this->birthdayreminderDataFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $birthdayreminderDataObject,
            $birthdayreminderData,
            BirthdayReminderInterface::class
        );
        
        return $birthdayreminderDataObject;
    }
}

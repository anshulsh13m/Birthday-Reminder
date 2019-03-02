<?php

namespace Ansh\BirthdayReminder\Model\Data;

use Ansh\BirthdayReminder\Api\Data\BirthdayReminderInterface;

class BirthdayReminder extends \Magento\Framework\Api\AbstractExtensibleObject implements BirthdayReminderInterface
{

    /**
     * Get birthdayreminder_id
     * @return string|null
     */
    public function getBirthdayreminderId()
    {
        return $this->_get(self::BIRTHDAYREMINDER_ID);
    }

    /**
     * Set birthdayreminder_id
     * @param string $birthdayreminderId
     * @return \Ansh\BirthdayReminder\Api\Data\BirthdayReminderInterface
     */
    public function setBirthdayreminderId($birthdayreminderId)
    {
        return $this->setData(self::BIRTHDAYREMINDER_ID, $birthdayreminderId);
    }

    /**
     * Get customer_id
     * @return string|null
     */
    public function getCustomerId()
    {
        return $this->_get(self::CUSTOMER_ID);
    }

    /**
     * Set customer_id
     * @param string $customerId
     * @return \Ansh\BirthdayReminder\Api\Data\BirthdayReminderInterface
     */
    public function setCustomerId($customerId)
    {
        return $this->setData(self::CUSTOMER_ID, $customerId);
    }

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \Ansh\BirthdayReminder\Api\Data\BirthdayReminderExtensionInterface|null
     */
    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }

    /**
     * Set an extension attributes object.
     * @param \Ansh\BirthdayReminder\Api\Data\BirthdayReminderExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Ansh\BirthdayReminder\Api\Data\BirthdayReminderExtensionInterface $extensionAttributes
    ) {
        return $this->_setExtensionAttributes($extensionAttributes);
    }

    /**
     * Get email
     * @return string|null
     */
    public function getEmail()
    {
        return $this->_get(self::EMAIL);
    }

    /**
     * Set email
     * @param string $email
     * @return \Ansh\BirthdayReminder\Api\Data\BirthdayReminderInterface
     */
    public function setEmail($email)
    {
        return $this->setData(self::EMAIL, $email);
    }

    /**
     * Get dob
     * @return string|null
     */
    public function getDob()
    {
        return $this->_get(self::DOB);
    }

    /**
     * Set dob
     * @param string $dob
     * @return \Ansh\BirthdayReminder\Api\Data\BirthdayReminderInterface
     */
    public function setDob($dob)
    {
        return $this->setData(self::DOB, $dob);
    }
}

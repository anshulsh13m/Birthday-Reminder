<?php


namespace Ansh\BirthdayReminder\Api\Data;

interface BirthdayReminderInterface extends \Magento\Framework\Api\ExtensibleDataInterface
{

    const CUSTOMER_ID = 'customer_id';
    const EMAIL = 'email';
    const DOB = 'dob';
    const BIRTHDAYREMINDER_ID = 'birthdayreminder_id';

    /**
     * Get birthdayreminder_id
     * @return string|null
     */
    public function getBirthdayreminderId();

    /**
     * Set birthdayreminder_id
     * @param string $birthdayreminderId
     * @return \Ansh\BirthdayReminder\Api\Data\BirthdayReminderInterface
     */
    public function setBirthdayreminderId($birthdayreminderId);

    /**
     * Get customer_id
     * @return string|null
     */
    public function getCustomerId();

    /**
     * Set customer_id
     * @param string $customerId
     * @return \Ansh\BirthdayReminder\Api\Data\BirthdayReminderInterface
     */
    public function setCustomerId($customerId);

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \Ansh\BirthdayReminder\Api\Data\BirthdayReminderExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * Set an extension attributes object.
     * @param \Ansh\BirthdayReminder\Api\Data\BirthdayReminderExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Ansh\BirthdayReminder\Api\Data\BirthdayReminderExtensionInterface $extensionAttributes
    );

    /**
     * Get email
     * @return string|null
     */
    public function getEmail();

    /**
     * Set email
     * @param string $email
     * @return \Ansh\BirthdayReminder\Api\Data\BirthdayReminderInterface
     */
    public function setEmail($email);

    /**
     * Get dob
     * @return string|null
     */
    public function getDob();

    /**
     * Set dob
     * @param string $dob
     * @return \Ansh\BirthdayReminder\Api\Data\BirthdayReminderInterface
     */
    public function setDob($dob);
}

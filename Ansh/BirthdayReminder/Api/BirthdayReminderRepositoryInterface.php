<?php


namespace Ansh\BirthdayReminder\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface BirthdayReminderRepositoryInterface
{

    /**
     * Save BirthdayReminder
     * @param \Ansh\BirthdayReminder\Api\Data\BirthdayReminderInterface $birthdayReminder
     * @return \Ansh\BirthdayReminder\Api\Data\BirthdayReminderInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Ansh\BirthdayReminder\Api\Data\BirthdayReminderInterface $birthdayReminder
    );

    /**
     * Retrieve BirthdayReminder
     * @param string $birthdayreminderId
     * @return \Ansh\BirthdayReminder\Api\Data\BirthdayReminderInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($birthdayreminderId);

    /**
     * Retrieve BirthdayReminder matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Ansh\BirthdayReminder\Api\Data\BirthdayReminderSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete BirthdayReminder
     * @param \Ansh\BirthdayReminder\Api\Data\BirthdayReminderInterface $birthdayReminder
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Ansh\BirthdayReminder\Api\Data\BirthdayReminderInterface $birthdayReminder
    );

    /**
     * Delete BirthdayReminder by ID
     * @param string $birthdayreminderId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($birthdayreminderId);
}

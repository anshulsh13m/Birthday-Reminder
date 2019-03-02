<?php


namespace Ansh\BirthdayReminder\Api\Data;

interface BirthdayReminderSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get BirthdayReminder list.
     * @return \Ansh\BirthdayReminder\Api\Data\BirthdayReminderInterface[]
     */
    public function getItems();

    /**
     * Set customer_id list.
     * @param \Ansh\BirthdayReminder\Api\Data\BirthdayReminderInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}

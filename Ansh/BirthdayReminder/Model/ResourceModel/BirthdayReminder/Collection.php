<?php


namespace Ansh\BirthdayReminder\Model\ResourceModel\BirthdayReminder;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            \Ansh\BirthdayReminder\Model\BirthdayReminder::class,
            \Ansh\BirthdayReminder\Model\ResourceModel\BirthdayReminder::class
        );
    }
}

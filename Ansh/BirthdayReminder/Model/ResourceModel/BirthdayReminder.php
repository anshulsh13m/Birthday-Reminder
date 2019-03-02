<?php


namespace Ansh\BirthdayReminder\Model\ResourceModel;

class BirthdayReminder extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('ansh_birthdayreminder_birthdayreminder', 'birthdayreminder_id');
    }
}

<?php

namespace Ansh\BirthdayReminder\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{
    /**
     * {@inheritdoc}
     */
    public function install(
        SchemaSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $table_ansh_birthdayreminder_birthdayreminder = $setup->getConnection()->newTable($setup->getTable('ansh_birthdayreminder_birthdayreminder'));

        $table_ansh_birthdayreminder_birthdayreminder->addColumn(
            'birthdayreminder_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            ['identity' => true,'nullable' => false,'primary' => true,'unsigned' => true,],
            'Entity ID'
        );

        $table_ansh_birthdayreminder_birthdayreminder->addColumn(
            'customer_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            [],
            'Customer Id'
        );

        $table_ansh_birthdayreminder_birthdayreminder->addColumn(
            'email',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            [],
            'Email Id'
        );

        $table_ansh_birthdayreminder_birthdayreminder->addColumn(
            'dob',
            \Magento\Framework\DB\Ddl\Table::TYPE_DATETIME,
            null,
            [],
            'Date of Birth'
        );

        $setup->getConnection()->createTable($table_ansh_birthdayreminder_birthdayreminder);
    }
}

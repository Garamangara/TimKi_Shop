<?php

namespace TimKi\Shop\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Adapter\AdapterInterface;

/**
 * @codeCoverageIgnore
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context) //@codingStandardsIgnoreLine
    {
        $setup->startSetup();

        $companyTable = $setup->getConnection()->newTable(
            $setup->getTable('timki_company')
        )->addColumn(
            'entity_id',
            Table::TYPE_SMALLINT,
            null,
            ['nullable' => false, Table::OPTION_UNSIGNED => true, 'identity' => true, 'primary' => true]
        )->addColumn(
            'title',
            Table::TYPE_TEXT,
            150,
            ['nullable' => false]
        )->addColumn(
            'description',
            Table::TYPE_TEXT,
            65536,
            ['nullable' => false]
        )->addIndex(
            $setup->getIdxName(
                $setup->getTable('timki_company'),
                ['entity_id'],
                AdapterInterface::INDEX_TYPE_UNIQUE
            ),
            ['entity_id'],
            ['type' => AdapterInterface::INDEX_TYPE_UNIQUE]
        )->setComment(
            'timki_company Table'
        );

        $setup->getConnection()->createTable($companyTable);

        $categoryTable = $setup->getConnection()->newTable(
            $setup->getTable('timki_category')
        )->addColumn(
            'entity_id',
            Table::TYPE_SMALLINT,
            null,
            ['nullable' => false, Table::OPTION_UNSIGNED => true, 'identity' => true, 'primary' => true]
        )->addColumn(
            'title',
            Table::TYPE_TEXT,
            150,
            ['nullable' => false]
        )->addIndex(
            $setup->getIdxName(
                $setup->getTable('timki_category'),
                ['entity_id'],
                AdapterInterface::INDEX_TYPE_UNIQUE
            ),
            ['entity_id'],
            ['type' => AdapterInterface::INDEX_TYPE_UNIQUE]
        )->setComment(
            'timki_category Table'
        );

        $setup->getConnection()->createTable($categoryTable);

        $dishTable = $setup->getConnection()->newTable(
            $setup->getTable('timki_dish')
        )->addColumn(
            'entity_id',
            Table::TYPE_SMALLINT,
            null,
            ['nullable' => false, Table::OPTION_UNSIGNED => true, 'identity' => true, 'primary' => true]
        )->addColumn(
            'title',
            Table::TYPE_TEXT,
            400,
            ['nullable' => false]
        )->addColumn(
            'image',
            Table::TYPE_TEXT,
            null,
            ['nullable' => true]
        )->addColumn(
            'description',
            Table::TYPE_TEXT,
            null,
            ['unsigned' => false, 'nullable' => false]
        )->addColumn(
            'price',
            Table::TYPE_DECIMAL,
            null,
            ['nullable' => true, Table::OPTION_UNSIGNED => true],
            'Next question ID'
        )->addColumn(
            'category_id',
            Table::TYPE_SMALLINT,
            null,
            ['nullable' => false, Table::OPTION_UNSIGNED => true]
        )->addColumn(
            'company_id',
            Table::TYPE_SMALLINT,
            null,
            ['nullable' => false, Table::OPTION_UNSIGNED => true]
        )->addForeignKey(
            $setup->getFkName(
                'timki_dish',
                'category_id',
                'timki_category',
                'entity_id'
            ),
            'category_id',
            $setup->getTable('timki_category'),
            'entity_id',
            Table::ACTION_CASCADE
        )->addForeignKey(
            $setup->getFkName(
                'timki_dish',
                'company_id',
                'timki_company',
                'entity_id'
            ),
            'company_id',
            $setup->getTable('timki_company'),
            'entity_id',
            Table::ACTION_CASCADE
        )->addIndex(
            $setup->getIdxName(
                $setup->getTable('timki_dish'),
                ['entity_id'],
                AdapterInterface::INDEX_TYPE_UNIQUE
            ),
            ['entity_id'],
            ['type' => AdapterInterface::INDEX_TYPE_UNIQUE]
        )->setComment(
            'timki_dish Table'
        );

        $setup->getConnection()->createTable($dishTable);

        $orderTable = $setup->getConnection()->newTable(
            $setup->getTable('timki_order')
        )->addColumn(
            'entity_id',
            Table::TYPE_SMALLINT,
            null,
            ['nullable' => false, Table::OPTION_UNSIGNED => true, 'identity' => true, 'primary' => true]
        )->addColumn(
            'customer_phone_number',
            Table::TYPE_TEXT,
            null,
            ['nullable' => false]
        )->addColumn(
            'customer_title',
            Table::TYPE_TEXT,
            null,
            ['nullable' => true]
        )->addColumn(
            'order_sku',
            Table::TYPE_SMALLINT,
            null,
            ['nullable' => false, Table::OPTION_UNSIGNED => true]
        )->addIndex(
            $setup->getIdxName(
                $setup->getTable('timki_order'),
                ['entity_id'],
                AdapterInterface::INDEX_TYPE_UNIQUE
            ),
            ['entity_id'],
            ['type' => AdapterInterface::INDEX_TYPE_UNIQUE]

        )->setComment(
            'timki_order Table'
        );

        $setup->getConnection()->createTable($orderTable);

        $categoryCompanyTable = $setup->getConnection()->newTable(
            $setup->getTable('timki_company_category')
        )->addColumn(
            'entity_id',
            Table::TYPE_SMALLINT,
            null,
            ['identity' => true, 'nullable' => false, 'primary' => true, Table::OPTION_UNSIGNED => true]
        )->addColumn(
            'company_id',
            Table::TYPE_SMALLINT,
            null,
            ['nullable' => false, Table::OPTION_UNSIGNED => true]
        )->addColumn(
            'category_id',
            Table::TYPE_SMALLINT,
            null,
            ['nullable' => false, Table::OPTION_UNSIGNED => true]
        )->addForeignKey(
            $setup->getFkName(
                'timki_company_category',
                'company_id',
                'timki_company',
                'entity_id'
            ),
            'company_id',
            $setup->getTable('timki_company'),
            'entity_id',
            Table::ACTION_CASCADE
        )->addForeignKey(
            $setup->getFkName(
                'timki_company_category',
                'category_id',
                'timki_category',
                'entity_id'
            ),
            'category_id',
            $setup->getTable('timki_category'),
            'entity_id',
            Table::ACTION_CASCADE
        )->addIndex(
            $setup->getIdxName(
                $setup->getTable('timki_company_category'),
                ['company_id', 'category_id'],
                AdapterInterface::INDEX_TYPE_INDEX
            ),
            ['company_id', 'category_id'],
            ['type' => AdapterInterface::INDEX_TYPE_INDEX]
        )->setComment(
            'timki_company_category Relations Table'
        );

        $setup->getConnection()->createTable($categoryCompanyTable);

        $orderProductTable = $setup->getConnection()->newTable(
            $setup->getTable('timki_order_dish')
        )->addColumn(
            'entity_id',
            Table::TYPE_SMALLINT,
            null,
            ['identity' => true, 'nullable' => false, 'primary' => true, Table::OPTION_UNSIGNED => true]
        )->addColumn(
            'order_id',
            Table::TYPE_SMALLINT,
            null,
            ['nullable' => false, Table::OPTION_UNSIGNED => true]
        )->addColumn(
            'dish_id',
            Table::TYPE_SMALLINT,
            null,
            ['nullable' => false, Table::OPTION_UNSIGNED => true]
        )->addForeignKey(
            $setup->getFkName(
                'timki_order_dish',
                'order_id',
                'timki_order',
                'entity_id'
            ),
            'order_id',
            $setup->getTable('timki_order'),
            'entity_id',
            Table::ACTION_CASCADE
        )->addForeignKey(
            $setup->getFkName(
                'timki_order_dish',
                'dish_id',
                'timki_dish',
                'entity_id'
            ),
            'dish_id',
            $setup->getTable('timki_dish'),
            'entity_id',
            Table::ACTION_CASCADE
        )->addIndex(
            $setup->getIdxName(
                $setup->getTable('timki_order_dish'),
                ['order_id', 'dish_id'],
                AdapterInterface::INDEX_TYPE_INDEX
            ),
            ['order_id', 'dish_id'],
            ['type' => AdapterInterface::INDEX_TYPE_INDEX]
        )->setComment(
            'timki_order_dish Relations Table'
        );

        $setup->getConnection()->createTable($orderProductTable);

        $setup->endSetup();
    }
}

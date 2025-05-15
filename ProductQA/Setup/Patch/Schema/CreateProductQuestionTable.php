<?php

namespace Magentoready\ProductQA\Setup\Patch\Schema;

use Magento\Framework\Setup\Patch\SchemaPatchInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\DB\Ddl\Table;

class CreateProductQuestionTable implements SchemaPatchInterface
{
    private $schemaSetup;

    public function __construct(SchemaSetupInterface $schemaSetup)
    {
        $this->schemaSetup = $schemaSetup;
    }

    public function apply()
    {
        $setup = $this->schemaSetup;
        $setup->startSetup();

        if (!$setup->tableExists('productqa_question')) {
            $table = $setup->getConnection()->newTable(
                $setup->getTable('productqa_question')
            )->addColumn(
                'question_id',
                Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'nullable' => false, 'primary' => true],
                'Question ID'
            )->addColumn(
                'product_id',
                Table::TYPE_INTEGER,
                null,
                ['nullable' => false],
                'Product ID'
            )->addColumn(
                'customer_name',
                Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'Customer Name'
            )->addColumn(
                'customer_email',
                Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'Customer Email'
            )->addColumn(
                'question_text',
                Table::TYPE_TEXT,
                '64k',
                ['nullable' => false],
                'Question Text'
            )->addColumn(
                'answer_text',
                Table::TYPE_TEXT,
                '64k',
                ['nullable' => true],
                'Answer Text'
            )->addColumn(
                'is_approved',
                Table::TYPE_BOOLEAN,
                null,
                ['nullable' => false, 'default' => 0],
                'Is Approved'
            )->addColumn(
                'created_at',
                Table::TYPE_TIMESTAMP,
                null,
                ['nullable' => false, 'default' => Table::TIMESTAMP_INIT],
                'Created At'
            )->setComment('Product Questions Table');

            $setup->getConnection()->createTable($table);
        }

        $setup->endSetup();
    }

    public static function getDependencies()
    {
        return [];
    }

    public function getAliases()
    {
        return [];
    }
}

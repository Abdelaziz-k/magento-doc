<?php
namespace Magentoready\ProductQA\Block\Adminhtml\Question\Grid;

use Magento\Backend\Block\Widget\Grid as WidgetGrid;

class Grid extends WidgetGrid
{
    protected function _construct()
    {
        parent::_construct();
        $this->setId('questionGrid');
        $this->setDefaultSort('entity_id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection()
    {
        $collection = \Magento\Framework\App\ObjectManager::getInstance()
            ->create('Magentoready\ProductQA\Model\ResourceModel\Question\Collection');
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('entity_id', [
            'header' => __('ID'),
            'index' => 'entity_id',
        ]);
        $this->addColumn('question', [
            'header' => __('Question'),
            'index' => 'question',
        ]);
        $this->addColumn('customer_name', [
            'header' => __('Customer'),
            'index' => 'customer_name',
        ]);
        $this->addColumn('created_at', [
            'header' => __('Created At'),
            'index' => 'created_at',
        ]);
        return parent::_prepareColumns();
    }
}

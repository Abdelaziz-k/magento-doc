<?php
namespace Magentoready\ProductQA\Block\Adminhtml\Question;

use Magento\Backend\Block\Widget\Grid\Extended;

class Grid extends Extended
{
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Backend\Helper\Data $backendHelper,
        \Magentoready\ProductQA\Model\ResourceModel\Question\CollectionFactory $collectionFactory,
        array $data = []
    ) {
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context, $backendHelper, $data);
    }

    protected function _construct()
    {
        parent::_construct();
        $this->setId('questionGrid');
        $this->setDefaultSort('question_id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection()
    {
        $collection = $this->collectionFactory->create();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('question_id', [
            'header' => __('Question ID'),
            'index' => 'question_id'
        ]);

        $this->addColumn('customer_name', [
            'header' => __('Customer Name'),
            'index' => 'customer_name'
        ]);

        $this->addColumn('customer_email', [
            'header' => __('Customer Email'),
            'index' => 'customer_email'
        ]);

        $this->addColumn('question_text', [
            'header' => __('Question Text'),
            'index' => 'question_text'
        ]);
        $this->addColumn('action', [
            'header' => __('Actions'),
            'type' => 'action',
            'getter' => 'getId',
            'actions' => [
                [
                    'caption' => __('Edit'),
                    'url' => ['base' => '*/*/edit'],
                    'field' => 'id'
                ],
                [
                    'caption' => __('Delete'),
                    'url' => ['base' => '*/*/delete'],
                    'field' => 'id',
                    'confirm' => __('Are you sure you want to delete this question?')
                ]
            ],
            'filter' => false,
            'sortable' => false,
            'index' => 'stores',
            'is_system' => true,
        ]);
        
        return parent::_prepareColumns();
    }
}

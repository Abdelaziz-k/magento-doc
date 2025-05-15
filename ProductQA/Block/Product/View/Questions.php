<?php

namespace Magentoready\ProductQA\Block\Product\View;

use Magento\Framework\View\Element\Template;
use Magento\Framework\Registry;
use Magentoready\ProductQA\Model\ResourceModel\Question\CollectionFactory;

class Questions extends Template
{
    protected $registry;
    protected $collectionFactory;

    public function __construct(
        Template\Context $context,
        Registry $registry,
        CollectionFactory $collectionFactory,
        array $data = []
    ) {
        $this->registry = $registry;
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context, $data);
    }

    public function getProduct()
    {
        return $this->registry->registry('current_product');
    }

    public function getApprovedQuestions()
    {
        return $this->collectionFactory->create()
            ->addFieldToFilter('product_id', $this->getProduct()->getId())
            ->addFieldToFilter('is_approved', 1)
            ->setOrder('created_at', 'DESC');
    }

    public function getFormAction()
    {
        return $this->getUrl('productqa/question/submit');
    }
}

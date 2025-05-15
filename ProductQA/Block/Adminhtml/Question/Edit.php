<?php

namespace Magentoready\ProductQA\Block\Adminhtml\Question;

use Magento\Backend\Block\Template\Context;
use Magento\Framework\Registry;
use Magento\Backend\Block\Template;

class Edit extends Template
{
    protected $registry;

    public function __construct(
        Context $context,
        Registry $registry,
        array $data = []
    ) {
        $this->registry = $registry;
        parent::__construct($context, $data);
    }

    public function getQuestion()
    {
        return $this->registry->registry('productqa_question');
    }

    public function getSaveUrl()
    {
        return $this->getUrl('*/*/save');
    }
}

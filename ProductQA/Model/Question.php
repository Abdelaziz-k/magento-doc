<?php

namespace Magentoready\ProductQA\Model;

use Magento\Framework\Model\AbstractModel;

class Question extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(\Magentoready\ProductQA\Model\ResourceModel\Question::class);
    }
}

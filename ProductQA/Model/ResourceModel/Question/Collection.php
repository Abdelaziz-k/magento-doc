<?php

namespace Magentoready\ProductQA\Model\ResourceModel\Question;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Magentoready\ProductQA\Model\Question as Model;
use Magentoready\ProductQA\Model\ResourceModel\Question as ResourceModel;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(Model::class, ResourceModel::class);
    }
}

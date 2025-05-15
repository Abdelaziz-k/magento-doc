<?php

namespace Magentoready\ProductQA\Ui\DataProvider\Question;

use Magento\Ui\DataProvider\AbstractDataProvider;
use Magentoready\ProductQA\Model\ResourceModel\Question\CollectionFactory;

class DataProvider extends AbstractDataProvider
{
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $collectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData()
    {
        return [
            'items' => $this->collection->getItems(),
            'totalRecords' => $this->collection->getSize()
        ];
    }
}

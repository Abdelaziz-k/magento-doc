<?php
namespace Magentoready\ProductQA\Controller\Adminhtml\Question;

class NewAction extends \Magento\Backend\App\Action
{
    public function execute()
    {
        $this->_forward('edit');
    }
}

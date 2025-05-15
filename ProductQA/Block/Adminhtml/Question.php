<?php
namespace Magentoready\ProductQA\Block\Adminhtml;

use Magento\Backend\Block\Widget\Grid\Container;

class Question extends Container
{
    protected function _construct()
    {
        $this->_controller = 'adminhtml_question';
        $this->_blockGroup = 'Magentoready_ProductQA';
        $this->_headerText = __('Product Questions');
        $this->_addButtonLabel = __('Add Question');

        parent::_construct();
    }
}

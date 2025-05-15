<?php

namespace Magentoready\ProductQA\Controller\Adminhtml\Question;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;

class Edit extends Action
{
    protected $coreRegistry;
    protected $resultPageFactory;

    public function __construct(
        Context $context,
        Registry $coreRegistry,
        PageFactory $resultPageFactory
    ) {
        $this->coreRegistry = $coreRegistry;
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        $model = $this->_objectManager->create(\Magentoready\ProductQA\Model\Question::class);
    
        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addErrorMessage(__('This question no longer exists.'));
                return $this->_redirect('*/*/');
            }
        }
    
        $this->coreRegistry->register('productqa_question', $model);
    
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend(__('Edit Question'));
    
        return $resultPage;
    }
}

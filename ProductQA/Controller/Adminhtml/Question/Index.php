<?php
namespace Magentoready\ProductQA\Controller\Adminhtml\Question;

use Magento\Backend\App\Action;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{
    protected $resultPageFactory;

    public function __construct(
        Action\Context $context,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Magentoready_ProductQA::questions');
        $resultPage->getConfig()->getTitle()->prepend(__('Product Questions'));
        return $resultPage;
    }
}

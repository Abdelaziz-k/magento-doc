<?php
namespace Magentoready\ProductQA\Controller\Adminhtml\Question;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magentoready\ProductQA\Model\QuestionFactory;

class Delete extends Action
{
    protected $questionFactory;

    public function __construct(
        Context $context,
        QuestionFactory $questionFactory
    ) {
        parent::__construct($context);
        $this->questionFactory = $questionFactory;
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        if ($id) {
            try {
                $model = $this->questionFactory->create()->load($id);
                if (!$model->getId()) {
                    throw new \Magento\Framework\Exception\LocalizedException(__('This question no longer exists.'));
                }

                $model->delete();
                $this->messageManager->addSuccessMessage(__('The question has been deleted.'));
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage(__('Error: ') . $e->getMessage());
            }
        } else {
            $this->messageManager->addErrorMessage(__('Cannot find a question to delete.'));
        }

        return $this->_redirect('*/*/');
    }
}

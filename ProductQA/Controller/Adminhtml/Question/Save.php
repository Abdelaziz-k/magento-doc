<?php
namespace Magentoready\ProductQA\Controller\Adminhtml\Question;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magentoready\ProductQA\Model\QuestionFactory;
use Magento\Framework\View\Result\PageFactory;

class Save extends Action
{
    protected $questionFactory;
    protected $resultPageFactory;

    public function __construct(
        Context $context,
        QuestionFactory $questionFactory,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->questionFactory = $questionFactory;
        $this->resultPageFactory = $resultPageFactory;
    }

    public function execute()
    {
        $data = $this->getRequest()->getPostValue();

        if ($data) {
            $model = $this->questionFactory->create();
            $id = isset($data['id']) ? (int)$data['id'] : null;

            if ($id) {
                $model->load($id);
                if (!$model->getId()) {
                    $this->messageManager->addErrorMessage(__('This question no longer exists.'));
                    return $this->_redirect('*/*/');
                }
                $model->addData($data);
            } else {
                $model->setData($data);
            }

            try {
                $model->save();
                $this->messageManager->addSuccessMessage(__('Question saved.'));
                return $this->_redirect('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage(__('Error: ') . $e->getMessage());
                return $this->_redirect('*/*/edit', ['id' => $id]);
            }
        }

        return $this->_redirect('*/*/');
    }
}

<?php

namespace Magentoready\ProductQA\Controller\Question;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magentoready\ProductQA\Model\QuestionFactory;
use Magento\Framework\Data\Form\FormKey\Validator;
use Magento\Framework\Message\ManagerInterface;
use Magento\Framework\Controller\Result\RedirectFactory;

class Submit extends Action
{
    protected $questionFactory;
    protected $formKeyValidator;
    protected $messageManager;
    protected $resultRedirectFactory;

    public function __construct(
        Context $context,
        QuestionFactory $questionFactory,
        Validator $formKeyValidator,
        ManagerInterface $messageManager,
        RedirectFactory $resultRedirectFactory
    ) {
        parent::__construct($context);
        $this->questionFactory = $questionFactory;
        $this->formKeyValidator = $formKeyValidator;
        $this->messageManager = $messageManager;
        $this->resultRedirectFactory = $resultRedirectFactory;
    }

    public function execute()
    {
        $data = $this->getRequest()->getPostValue();

        $resultRedirect = $this->resultRedirectFactory->create();
        $refererUrl = $this->_redirect->getRefererUrl();

        if (!$data || empty($data['product_id'])) {
            $this->messageManager->addErrorMessage(__('Invalid submission.'));
            return $resultRedirect->setUrl($refererUrl);
        }

        try {
            $question = $this->questionFactory->create();
            $question->setData([
                'product_id' => (int)$data['product_id'],
                'customer_name' => trim($data['customer_name']),
                'customer_email' => trim($data['customer_email']),
                'question_text' => trim($data['question_text']),
                'is_approved' => 0,
            ]);
            $question->save();
            $this->messageManager->addSuccessMessage(__('Your question has been submitted and is awaiting approval.'));
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__('Unable to submit question. Please try again later.'));
        }

        return $resultRedirect->setUrl($refererUrl);
    }
}

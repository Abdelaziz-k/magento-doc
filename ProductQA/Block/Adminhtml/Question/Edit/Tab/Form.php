<?php
namespace Magentoready\ProductQA\Block\Adminhtml\Question\Edit\Tab;

use Magento\Backend\Block\Widget\Form\Generic;

class Form extends Generic
{
    protected function _prepareForm()
    {
        $model = $this->_coreRegistry->registry('productqa_question');

        $form = $this->_formFactory->create();
        $form->setHtmlIdPrefix('question_');

        $fieldset = $form->addFieldset('base_fieldset', [
            'legend' => __('Question Information'),
            'class'  => 'fieldset-wide'
        ]);

        if ($model->getId()) {
            $fieldset->addField('question_id', 'hidden', ['name' => 'question_id']);
        }

        $fieldset->addField('customer_name', 'text', [
            'name' => 'customer_name',
            'label' => __('Customer Name'),
            'required' => true
        ]);

        $fieldset->addField('customer_email', 'text', [
            'name' => 'customer_email',
            'label' => __('Customer Email'),
            'required' => true
        ]);

        $fieldset->addField('question_text', 'textarea', [
            'name' => 'question_text',
            'label' => __('Question Text'),
            'required' => true
        ]);

        $fieldset->addField('answer_text', 'textarea', [
            'name' => 'answer_text',
            'label' => __('Answer (Optional)'),
            'required' => false
        ]);

        $fieldset->addField('is_approved', 'select', [
            'name' => 'is_approved',
            'label' => __('Approved?'),
            'required' => true,
            'values' => [
                ['value' => 1, 'label' => __('Yes')],
                ['value' => 0, 'label' => __('No')],
            ]
        ]);

        $form->setValues($model->getData());
        $this->setForm($form);

        return parent::_prepareForm();
    }
}

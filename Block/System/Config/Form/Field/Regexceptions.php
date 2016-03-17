<?php
/**
 * Copyright © 2016 ShopGo. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace ShopGo\AdminThemeSwitcher\Block\System\Config\Form\Field;

/**
 * Backend system config array field renderer
 */
class Regexceptions extends \Magento\Config\Block\System\Config\Form\Field\FieldArray\AbstractFieldArray
{
        /**
     * @var \Magento\Framework\Data\Form\Element\Factory
     */
    protected $_elementFactory;

    /**
     * @var string
     */
    protected $_labelClass;

    /**
     * Object manager
     *
     * @var \Magento\Framework\ObjectManagerInterface
     */
    protected $_objectManager;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Data\Form\Element\Factory $elementFactory
     * @param \Magento\Framework\ObjectManagerInterface $objectManager
     * @param string $labelClass
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Data\Form\Element\Factory $elementFactory,
        \Magento\Framework\ObjectManagerInterface $objectManager,
        $labelClass = '',
        array $data = []
    ) {
        $this->_elementFactory = $elementFactory;
        $this->_objectManager = $objectManager;
        $this->_labelClass = $labelClass;
        parent::__construct($context, $data);
    }

    /**
     * Initialise form fields
     *
     * @return void
     */
    protected function _construct()
    {
        $this->addColumn('search', ['label' => __('Search String')]);
        $this->addColumn('value', ['label' => __('Design Theme')]);
        $this->_addAfter = false;
        $this->_addButtonLabel = __('Add \Exception');
        parent::_construct();
    }

    /**
     * Render array cell for prototypeJS template
     *
     * @param string $columnName
     * @return string
     */
    public function renderCellTemplate($columnName)
    {
        if ($columnName == 'value' && isset($this->_columns[$columnName])) {
            /** @var $label \Magento\Framework\View\Design\Theme\Label */
            $label = $this->_objectManager->create($this->_labelClass);
            $options = $label->getLabelsCollection(__('-- No Theme --'));
            $element = $this->_elementFactory->create('select');
            $element->setForm(
                $this->getForm()
            )->setName(
                $this->_getCellInputElementName($columnName)
            )->setHtmlId(
                $this->_getCellInputElementId('<%- _id %>', $columnName)
            )->setValues(
                $options
            );
            return str_replace("\n", '', $element->getElementHtml());
        }

        return parent::renderCellTemplate($columnName);
    }
}

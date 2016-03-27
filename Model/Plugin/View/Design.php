<?php
/**
 * Copyright © 2016 ShopGo. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace ShopGo\AdminThemeSwitcher\Model\Plugin\View;

use Magento\Theme\Model\View\Design as ViewDesign;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\Area;

/**
 * View design plugin
 */
class Design
{
    /**
     * Admin theme design configuration XML path
     */
    const XML_PATH_ADMIN_THEME_ID = 'design/theme/admin_theme_id';

    /**
     * @var ViewDesign
     */
    protected $_viewDesign;

    /**
     * @var ScopeConfigInterface
     */
    protected $_scopeConfig;

    /**
     * @param ViewDesign $viewDesign
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        ViewDesign $viewDesign,
        ScopeConfigInterface $scopeConfig
    ) {
        $this->_viewDesign  = $viewDesign;
        $this->_scopeConfig = $scopeConfig;
    }

    /**
     * Get admin theme
     *
     * @param ViewDesign $subject
     * @param string|int $result
     * @return string|int
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function afterGetConfigurationDesignTheme(ViewDesign $subject, $result)
    {
        $theme = $result;

        if ($this->_viewDesign->getArea() == Area::AREA_ADMINHTML) {
            $theme = $this->_scopeConfig->getValue(
                self::XML_PATH_ADMIN_THEME_ID,
                ScopeConfigInterface::SCOPE_TYPE_DEFAULT
            );
        }

        return $theme ? $theme : $result;
    }
}

<?php
/**
 * Copyright © 2016 ShopGo. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace ShopGo\AdminThemeSwitcher\Model\ResourceModel\Theme;

/**
 * Theme collection
 */
class Collection extends \Magento\Theme\Model\ResourceModel\Theme\Collection
{
    /**
     * @return $this
     */
    public function loadRegisteredThemes()
    {
        $this->_reset()->clear();
        return $this->setOrder('theme_title', \Magento\Framework\Data\Collection::SORT_ORDER_ASC)
            ->filterVisibleThemes()->addAreaFilter(\Magento\Framework\App\Area::AREA_ADMINHTML);
    }
}

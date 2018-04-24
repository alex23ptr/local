<?php
class AP_ModBanners_Block_View extends Mage_Core_Block_Template
{
    public function getCurrentBanner()
    {
        return Mage::registry('current_banner');
    }
    
    public function getBannerCollection()
    {
        $banner = $this->getCurrentBanner();
        if (!$banner) {
            return array();
        }
         
    }
}
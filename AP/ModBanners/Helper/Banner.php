<?php
class AP_ModBanners_Helper_Banner extends Mage_Core_Helper_Abstract
{
    public function getBannerUrl(AP_ModBanners_Model_Banner $banner)
    {
        if (!$banner instanceof AP_ModBanners_Model_Banner) {
            return '#';
        }
        
        return $this->_getUrl(
            'ap_modbanners/index/view', 
            array(
                //'url' => "banner-".$banner->getId(),
                'id' => $banner->entity_id,
            )
        );
    }
}
<?php
class AP_ModBanners_Model_Resource_Banner_Collection
    extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    protected function _construct()
    {
        parent::_construct();
        
        
        $this->_init(
            'ap_modbanners/banner',
            'ap_modbanners/banner'
        );
    }
}
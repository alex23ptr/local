<?php
class AP_ModBanners_Model_Banner
    extends Mage_Core_Model_Abstract
{
       
    protected function _construct()
    {
        parent::_construct();
        $this->_init('modBanners/Banner');
    }  

 
}
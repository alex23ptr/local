<?php
class AP_ModBanners_Model_Banner
    extends Mage_Core_Model_Abstract
{
       
    protected function _construct()
    {
        parent::_construct();
        $this->_init('ap_modbanners/banner');
    }  
	
	public function getBanners() {
    $banners =  array( 1 => array('entity_id' => 1, 'title' => 'First title', 'description' => 'Banner descripon'), 
					   2 => array('entity_id' => 2, 'title' => 'Second title', 'description' => 'Banner descripon'), 
						);
    return $banners;
  }

 
}
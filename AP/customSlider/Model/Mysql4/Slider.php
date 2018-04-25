<?php
class AP_customSlider_Model_Mysql4_Slider
    extends Mage_Core_Model_Mysql4_Abstract
       
    protected function _construct()
    {
        parent::_construct();
        $this->_init('customSlider/Slider', 'slider_id');
		 
    }  

 
}
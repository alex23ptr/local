<?php
class AP_ModBanners_Block_Adminhtml_Banner
    extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    protected function _construct()
    {	
        parent::_construct();       
        
        $this->_blockGroup = 'ap_modbanners_adminhtml';        
     
        $this->_controller = 'banner';        
       
        $this->_headerText = Mage::helper('ap_modbanners')
            ->__('Banners list');
    }
    
    public function getCreateUrl()
    {
         
        return $this->getUrl(
            'ap_modbanners_admin/banner/edit'
        );
    }
}
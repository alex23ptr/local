<?php
class AP_modBanners_Block_Adminhtml_Banner_Edit
    extends Mage_Adminhtml_Block_Widget_Form_Container
{
    protected function _construct()
    {
        $this->_blockGroup = 'ap_modbanners_adminhtml';
        $this->_controller = 'banner';        
       
        $this->_mode = 'edit';
        
        $newOrEdit = $this->getRequest()->getParam('id')
            ? $this->__('Edit')
            : $this->__('New');
        $this->_headerText =  $newOrEdit . ' ' . $this->__('Banner');
    }
}
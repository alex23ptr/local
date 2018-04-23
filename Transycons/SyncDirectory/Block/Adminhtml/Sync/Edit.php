<?php
class Transycons_SyncDirectory_Block_Adminhtml_Sync_Edit
    extends Mage_Adminhtml_Block_Widget_Form_Container
{
    protected function _construct()
    {
        $this->_blockGroup = 'transycons_syncdirectory_adminhtml';
        $this->_controller = 'sync';
        
        /**
         * The $_mode property tells Magento which folder to use to
         * locate the related form blocks to be displayed within this
         * form container. In our example this corresponds to 
         * SyncDirectory/Block/Adminhtml/Sync/Edit/.
         */
        $this->_mode = 'edit';
        
        $newOrEdit = $this->getRequest()->getParam('id')
            ? $this->__('Edit')
            : $this->__('New');
        $this->_headerText =  $newOrEdit . ' ' . $this->__('Sync');
    }
}
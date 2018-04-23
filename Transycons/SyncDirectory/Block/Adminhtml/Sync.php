<?php
class Transycons_SyncDirectory_Block_Adminhtml_Sync
    extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    protected function _construct()
    {
        parent::_construct();
        
        /**
         * The $_blockGroup property tells Magento which alias to use to
         * locate the blocks to be displayed within this grid container.
         * In our example this corresponds to SyncDirectory/Block/Adminhtml.
         */
        $this->_blockGroup = 'transycons_syncdirectory_adminhtml';
        
        /**
         * $_controller is a bit of a confusing name for this property. This 
         * value in fact refers to the folder containing our Grid.php and 
         * Edit.php. In our example, SyncDirectory/Block/Adminhtml/Sync,
         * so we use 'sync'.
         */
        $this->_controller = 'sync';
        
        /**
         * The title of the page in the admin panel.
         */
        $this->_headerText = Mage::helper('transycons_syncdirectory')
            ->__('Lista sincronizare ID');
    }
    
    public function getCreateUrl()
    {
        /**
         * When the Add button is clicked, this is where the user should
         * be redirected to. In our example, the method editAction of 
         * SyncController.php in SyncDirectory module.
         */
        return $this->getUrl(
            'transycons_syncdirectory_admin/sync/edit'
        );
    }
}
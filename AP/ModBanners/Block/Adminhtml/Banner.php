<?php
class AP_ModBanners_Block_Adminhtml_Banner
    extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    protected function _construct()
    {	
        parent::_construct();
        
        /**
         * The $_blockGroup property tells Magento which alias to use to
         * locate the blocks to be displayed within this grid container.
         * In our example this corresponds to modBanners/Block/Adminhtml.
         */
        $this->_blockGroup = 'ap_modbanners_adminhtml';
        
        /**
         * $_controller is a bit of a confusing name for this property. This 
         * value in fact refers to the folder containing our Grid.php and 
         * Edit.php. In our example, modBanners/Block/Adminhtml/Banner,
         * so we use 'banner'.
         */
        $this->_controller = 'banner';
        
        /**
         * The title of the page in the admin panel.
         */
        $this->_headerText = Mage::helper('ap_modbanners')
            ->__('Banners list');
    }
    
    public function getCreateUrl()
    {
        /**
         * When the Add button is clicked, this is where the user should
         * be redirected to. In our example, the method editAction of 
         * BannerController.php in modbanners module.
         */
        return $this->getUrl(
            'ap_modbanners_admin/banner/edit'
        );
    }
}
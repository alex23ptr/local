<?php
class AP_ModBanners_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
		
		$this->loadLayout();
		$this->getLayout()->getBlock("head")->setTitle($this->__("Banners page"));
		
	    $breadcrumbs = $this->getLayout()->getBlock("breadcrumbs");
		$breadcrumbs->addCrumb("home", array(
					"label" => $this->__("Home Page"),
					"title" => $this->__("Home Page"),
					"link"  => Mage::getBaseUrl()
			   ));

		$breadcrumbs->addCrumb("Banners", array(
					"label" => $this->__("Banners"),
					"title" => $this->__("Banners")
			   ));
		$this->renderLayout();      

        
    }
	
	public function testAction()
    {
        echo "test action";
    }
	public function viewAction()
    {
        $banner = Mage::getModel('ap_modbanners/banner');
        /*
        $urlKey = $this->getRequest()->getParam('url', '');
        if (strlen($urlKey) > 0) {
            $banner->load($urlKey, 'url_key');
        } else {
            $id = (int)$this->getRequest()->getParam('id', 0);
            $banner->load($id);
        }*/
		
		$id = (int)$this->getRequest()->getParam('id', 0);
           $banner->load($id);
         
        if ($banner->getId() < 1) {
            $this->_redirect('*/*/index');
        }
        
        Mage::register('current_banner', $banner);
        
        $this->loadLayout()->renderLayout();
    }
}
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
        //echo "Hello from module";	 

        
    }
	
	public function testAction()
    {
        echo "test action";
    }
}
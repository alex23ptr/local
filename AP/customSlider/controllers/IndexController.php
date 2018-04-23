<?php
class AP_customSlider_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
		
		$this->loadLayout();
		$this->getLayout()->getBlock("head")->setTitle($this->__("Slider page"));
	    $breadcrumbs = $this->getLayout()->getBlock("breadcrumbs");
		$breadcrumbs->addCrumb("home", array(
					"label" => $this->__("Home Page"),
					"title" => $this->__("Home Page"),
					"link"  => Mage::getBaseUrl()
			   ));

		$breadcrumbs->addCrumb("customslider", array(
					"label" => $this->__("custom slider"),
					"title" => $this->__("custom slider")
			   ));
		$this->renderLayout();
        //echo "Hello from module";	 

        
    }
	
	public function testAction()
    {
        echo "test action";
    }
}
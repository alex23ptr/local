<?php
class AP_ModBanners_Adminhtml_BannerController
    extends Mage_Adminhtml_Controller_Action
{
     
    public function indexAction()
    {  
         
        $bannerBlock = $this->getLayout()
            ->createBlock('ap_modbanners_adminhtml/banner');
        
         
        $this->loadLayout()
            ->_addContent($bannerBlock)
            ->renderLayout();  
    }
    
    /**
     * This action handles both viewing and editing of existing banners.
     */
    public function editAction()
    {
        
        $banner = Mage::getModel('ap_modbanners/banner');
        if ($bannerId = $this->getRequest()->getParam('id', false)) {
            $banner->load($bannerId);

            if ($banner->getId() < 1) {
                $this->_getSession()->addError(
                    $this->__('This relation no longer exists.')
                );
                return $this->_redirect(
                    'ap_modbanners_admin/banner/index'
                );
            }
        }
        
        
        if ($postData = $this->getRequest()->getPost('bannerData')) {
			
			if(isset($_FILES['bannerData']['name']['image_path']) && file_exists($_FILES['bannerData']['tmp_name']['image_path'])) { 
				
			  $_FILES['image']['name'] = $_FILES['bannerData']['name']['image_path'] ;
			  $_FILES['image']['type'] = $_FILES['bannerData']['type']['image_path'] ;
			  $_FILES['image']['tmp_name'] = $_FILES['bannerData']['tmp_name']['image_path'] ;
			  $_FILES['image']['error'] = $_FILES['bannerData']['error']['image_path'] ;
			  $_FILES['image']['size'] = $_FILES['bannerData']['size']['image_path'] ;
			  unset($_FILES['bannerData']);
			}
			 
			if(isset($_FILES['image']['name']) && file_exists($_FILES['image']['tmp_name'])) {				
			 
			  try { 
				$uploader = new Varien_File_Uploader('image'); 
				$uploader->setAllowedExtensions(array('jpg','jpeg','bmp','png')); // or pdf or anything
			  
			  
				$uploader->setAllowRenameFiles(false);
			  
				 
				$uploader->setFilesDispersion(false);
				
				$path = Mage::getBaseDir('media') . DS ;
							
				$uploader->save($path, $_FILES['image']['name']);			  
				$postData['image_path'] = $_FILES['image']['name']; 
				   
			  }catch(Exception $e) {
			   //echo $e->getMessage();
			    Mage::logException($e);
                $this->_getSession()->addError($e->getMessage());
			  }
			  
			} else {      
  
				if(isset($postData['bannerData']['image_path']['delete']) && $postData['bannerData']['image_path']['delete'] == 1)
					$postData['image_path'] = '';
				else
					unset($postData['image_path']);
			} 
			 
            try {
                $banner->addData($postData);
                $banner->save();
                
                $this->_getSession()->addSuccess(
                    $this->__('The banner has been saved.')
                );
                
                 
                return $this->_redirect(
                    'ap_modbanners_admin/banner/edit',
                    array('id' => $banner->getId())
                );
            } catch (Exception $e) {
                Mage::logException($e);
                $this->_getSession()->addError($e->getMessage());
            }
            
             
        }
        
         
        Mage::register('current_banner', $banner);
        
         
        $bannerEditBlock = $this->getLayout()->createBlock(
            'ap_modbanners_adminhtml/banner_edit'
        );
        
          
        $this->loadLayout()
            ->_addContent($bannerEditBlock)
            ->renderLayout();
    }
    
    public function deleteAction()
    {
        $banner = Mage::getModel('ap_modbanners/banner');

        if ($bannerId = $this->getRequest()->getParam('id', false)) {
            $banner->load($bannerId);
        }
        
        if ($banner->getId() < 1) {
            $this->_getSession()->addError(
                $this->__('This banner no longer exists.')
            );
            return $this->_redirect(
                'ap_modbanners_admin/banner/index'
            );
        }
        
        try {
            $banner->delete();
            
            $this->_getSession()->addSuccess(
                $this->__('The banner has been deleted.')
            );
        } catch (Exception $e) {
            Mage::logException($e);
            $this->_getSession()->addError($e->getMessage());
        }

        return $this->_redirect(
            'ap_modbanners_admin/banner/index'
        );
    }
	
	 
    
     
    protected function _isAllowed()
    {
         
        $actionName = $this->getRequest()->getActionName();
        switch ($actionName) {
            case 'index':
            case 'edit':
            case 'delete':
                // intentionally no break
            default:
                $adminSession = Mage::getSingleton('admin/session');
                $isAllowed = $adminSession
                    ->isAllowed('ap_modbanners/banner');
                break;
        }
        
        return $isAllowed;
    }
}
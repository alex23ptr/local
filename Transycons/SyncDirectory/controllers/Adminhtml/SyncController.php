<?php
class Transycons_SyncDirectory_Adminhtml_SyncController
    extends Mage_Adminhtml_Controller_Action
{
    /**
     * Instantiate our grid container block and add to the page content.
     * When accessing this admin index page we will see a grid of all
     * sync currently available in our Magento instance, along with
     * a button to add a new one if we wish.
     */
    public function indexAction()
    {
        // instantiate the grid container
        $syncBlock = $this->getLayout()
            ->createBlock('transycons_syncdirectory_adminhtml/sync');
        
        // add the grid container as the only item on this page
        $this->loadLayout()
            ->_addContent($syncBlock)
            ->renderLayout();  
    }
    
    /**
     * This action handles both viewing and editing of existing syncs.
     */
    public function editAction()
    {
        /**
         * retrieving existing sync data if an ID was specified,
         * if not we will have an empty Relation entity ready to be populated.
         */
        $sync = Mage::getModel('transycons_syncdirectory/sync');
        if ($syncId = $this->getRequest()->getParam('id', false)) {
            $sync->load($syncId);

            if ($sync->getId() < 1) {
                $this->_getSession()->addError(
                    $this->__('This relation no longer exists.')
                );
                return $this->_redirect(
                    'transycons_syncdirectory_admin/sync/index'
                );
            }
        }
        
        // process $_POST data if the form was submitted
        if ($postData = $this->getRequest()->getPost('syncData')) {
            try {
                $sync->addData($postData);
                $sync->save();
                
                $this->_getSession()->addSuccess(
                    $this->__('The relation has been saved.')
                );
                
                // redirect to remove $_POST data from the request
                return $this->_redirect(
                    'transycons_syncdirectory_admin/sync/edit',
                    array('id' => $sync->getId())
                );
            } catch (Exception $e) {
                Mage::logException($e);
                $this->_getSession()->addError($e->getMessage());
            }
            
            /**
             * if we get to here then something went wrong. Continue to
             * render the page as before, the difference being this time 
             * the submitted $_POST data is available.
             */
        }
        
        // make the current sync object available to blocks
        Mage::register('current_sync', $sync);
        
        // instantiate the form container
        $syncEditBlock = $this->getLayout()->createBlock(
            'transycons_syncdirectory_adminhtml/sync_edit'
        );
        
        // add the form container as the only item on this page
        $this->loadLayout()
            ->_addContent($syncEditBlock)
            ->renderLayout();
    }
    
    public function deleteAction()
    {
        $sync = Mage::getModel('transycons_syncdirectory/sync');

        if ($syncId = $this->getRequest()->getParam('id', false)) {
            $sync->load($syncId);
        }
        
        if ($sync->getId() < 1) {
            $this->_getSession()->addError(
                $this->__('This sync no longer exists.')
            );
            return $this->_redirect(
                'transycons_syncdirectory_admin/sync/index'
            );
        }
        
        try {
            $sync->delete();
            
            $this->_getSession()->addSuccess(
                $this->__('The sync has been deleted.')
            );
        } catch (Exception $e) {
            Mage::logException($e);
            $this->_getSession()->addError($e->getMessage());
        }

        return $this->_redirect(
            'transycons_syncdirectory_admin/sync/index'
        );
    }
    
    /**
     * Thanks to Ben for pointing out this method was missing. Without 
     * this method the ACL rules configured in adminhtml.xml are ignored.
     */
    protected function _isAllowed()
    {
        /**
         * we include this switch to demonstrate that you can add action 
         * level restrictions in your ACL rules. The isAllowed() method will
         * use the ACL rule we have configured in our adminhtml.xml file:
         * - acl 
         * - - resources
         * - - - admin
         * - - - - children
         * - - - - - transycons_syncdirectory
         * - - - - - - children
         * - - - - - - - sync
         * 
         * eg. you could add more rules inside sync for edit and delete.
         */
        $actionName = $this->getRequest()->getActionName();
        switch ($actionName) {
            case 'index':
            case 'edit':
            case 'delete':
                // intentionally no break
            default:
                $adminSession = Mage::getSingleton('admin/session');
                $isAllowed = $adminSession
                    ->isAllowed('transycons_syncdirectory/sync');
                break;
        }
        
        return $isAllowed;
    }
}
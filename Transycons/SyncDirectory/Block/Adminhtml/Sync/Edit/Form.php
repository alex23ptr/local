<?php
class Transycons_SyncDirectory_Block_Adminhtml_Sync_Edit_Form
    extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        // instantiate a new form to display our sync for editing
        $form = new Varien_Data_Form(array(
            'id' => 'edit_form',
            'action' => $this->getUrl(
                'transycons_syncdirectory_admin/sync/edit',
                array(
                    '_current' => true,
                    'continue' => 0,
                )
            ),
            'method' => 'post',
			'enctype' => 'multipart/form-data'//files
        ));
        $form->setUseContainer(true);
        $this->setForm($form);
        
        // define a new fieldset, we only need one for our simple entity
        $fieldset = $form->addFieldset(
            'general',
            array(
                'legend' => $this->__('Sync Details')
            )
        );
        

        
        // add the fields we want to be editable
        $this->_addFieldsToFieldset($fieldset, array(

            'regius_id' => array(
                'label' => $this->__('Regius Id'),
                'input' => 'text',
                'required' => true,
            ),
            'emag_id' => array(
                'label' => $this->__('Emag Id'),
                'input' => 'text',
                'required' => true,
            ),
             'name' => array(
                'label' => $this->__('Nume'),
                'input' => 'text',
                'required' => false,
            ),
            'product_sku' => array(
                'label' => $this->__('Sku'),
                'input' => 'text',
                'required' => false,
            ),
            'qty' => array(
                'label' => $this->__('Cantitate'),
                'input' => 'text',
                'required' => false,
            ),

            
            /**
             * Note: we have not included created_at or updated_at,
             * we will handle those fields ourself in the Model before save.
             */
        ));
		
		$fieldset->addField('fileinputname', 'file', array(
          'label'     => Mage::helper('pictos')->__('File label'),
          'required'  => false,
          'name'      => 'fileinputname',
		));

        return $this;
    }
    
    /**
     * This method makes life a little easier for us by pre-populating 
     * fields with $_POST data where applicable and wraps our post data in 
     * 'syncData' so we can easily separate all relevant information in
     * the controller. You can of course omit this method entirely and call
     * the $fieldset->addField() method directly.
     */
    protected function _addFieldsToFieldset(
        Varien_Data_Form_Element_Fieldset $fieldset, $fields)
    {
        $requestData = new Varien_Object($this->getRequest()
            ->getPost('syncData'));
        
        foreach ($fields as $name => $_data) {
            if ($requestValue = $requestData->getData($name)) {
                $_data['value'] = $requestValue;
            }
            
            // wrap all fields with syncData group
            $_data['name'] = "syncData[$name]";
            
            // generally label and title always the same
            $_data['title'] = $_data['label'];
            
            // if no new value exists, use existing sync data
            if (!array_key_exists('value', $_data)) {
                $_data['value'] = $this->_getSync()->getData($name);
            }
            
            // finally call vanilla functionality to add field
            $fieldset->addField($name, $_data['input'], $_data);
        }
        
        return $this;
    }
    
    /**
     * Retrieve the existing sync for pre-populating the form fields.
     * For a new sync entry this will return an empty Sync object.
     */
    protected function _getSync()
    {
        if (!$this->hasData('sync')) {
            // this will have been set in the controller
            $sync = Mage::registry('current_sync');
            
            // just in case the controller does not register the sync
            if (!$sync instanceof
                    Transycons_SyncDirectory_Model_Sync) {
                $sync = Mage::getModel(
                    'transycons_syncdirectory/sync'
                );
            }
            
            $this->setData('sync', $sync);
        }
        
        return $this->getData('sync');
    }
}
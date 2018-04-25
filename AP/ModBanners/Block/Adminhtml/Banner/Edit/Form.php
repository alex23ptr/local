<?php
class AP_modBanners_Block_Adminhtml_Banner_Edit_Form
    extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        // instantiate a new form to display our banner for editing
        $form = new Varien_Data_Form(array(
            'id' => 'edit_form',
            'action' => $this->getUrl(
                'ap_modbanners_admin/banner/edit',
                array(
                    '_current' => true,
                    'continue' => 0,
                )
            ),
            'method' => 'post',
			'enctype' => 'multipart/form-data'
        ));
        $form->setUseContainer(true);
        $this->setForm($form);
        
        // define a new fieldset, we only need one for our simple entity
        $fieldset = $form->addFieldset(
            'general',
            array(
                'legend' => $this->__('Banner Details')
            )
        );
        

        
        // add the fields we want to be editable
        $this->_addFieldsToFieldset($fieldset, array(

            'title' => array(
                'label' => $this->__('Title'),
                'input' => 'text',
                'required' => true,
            ),
            'image_path' => array(
                'label' => $this->__('Image'),
                'input' => 'image',
                'required' => true,
				'note' => '(*.jpg, *.png, *.gif)',
            ),
			
             'description' => array(
                'label' => $this->__('Description'),
                'input' => 'textarea',
                'required' => false,
            ),
			
              
            /*
			'start_date' => array(
                'label' => $this->__('Start date'),
                'input' => 'text',
                'required' => false,
            ),
			'end_date' => array(
                'label' => $this->__('End date'),
                'input' => 'text',
                'required' => false,
            ), */

            
            
        ));
		 
		 			
		// $dateFormatIso = Mage::app()->getLocale()->getDateTimeFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT);
		$fieldset->addField('start_date', 'date', array(
		  'name'   => 'bannerData[start_date]',
		  'label'  => $this->__('Start Date'),
		  'title'  => $this->__('Start Date'),
		  'image'  => $this->getSkinUrl('images/grid-cal.gif'),
		  'input_format' => 'yyyy-M-d H:mm:ss',
		  'format'       => 'yyyy-M-d H:mm:ss',//$dateFormatIso,
		  'time' => true
		));
		$fieldset->addField('end_date', 'date', array(
		  'name'   => 'bannerData[end_date]',
		  'label'  => $this->__('End Date'),
		  'title'  => $this->__('End Date'),
		  'image'  => $this->getSkinUrl('images/grid-cal.gif'),
		  'input_format' => 'yyyy-M-d H:mm:ss',
		  'format'       => 'yyyy-M-d H:mm:ss',//$dateFormatIso,
		  'time' => true
		));

        return $this;
    }
    
    /**
     * This method makes life a little easier for us by pre-populating 
     * fields with $_POST data where applicable and wraps our post data in 
     * 'bannerData' so we can easily separate all relevant information in
     * the controller. You can of course omit this method entirely and call
     * the $fieldset->addField() method directly.
     */
    protected function _addFieldsToFieldset(
        Varien_Data_Form_Element_Fieldset $fieldset, $fields)
    {
        $requestData = new Varien_Object($this->getRequest()
            ->getPost('bannerData'));
        
        foreach ($fields as $name => $_data) {
            if ($requestValue = $requestData->getData($name)) {
                $_data['value'] = $requestValue;
            }
            
            // wrap all fields with bannerData group
            $_data['name'] = "bannerData[$name]";
            
            // generally label and title always the same
            $_data['title'] = $_data['label'];
            
            // if no new value exists, use existing banner data
            if (!array_key_exists('value', $_data)) {
                $_data['value'] = $this->_getBanner()->getData($name);
            }
            
            // finally call vanilla functionality to add field
            $fieldset->addField($name, $_data['input'], $_data);
        }
        
        return $this;
    }
    
    
    protected function _getBanner()
    {
        if (!$this->hasData('banner')) {
            // this will have been set in the controller
            $banner = Mage::registry('current_banner');
            
            // just in case the controller does not register the banne
            if (!$banner instanceof
                    AP_ModBanners_Model_Banner) {
                $banner = Mage::getModel(
                    'ap_modbanners/banner'
                );
            }
            
            $this->setData('banner', $banner);
        }
        
        return $this->getData('banner');
    }
}
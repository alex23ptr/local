<?php
class AP_ModBanners_Block_Adminhtml_Banner_Grid
    extends Mage_Adminhtml_Block_Widget_Grid
{
    protected function _prepareCollection()
    {
        /**
         * Tell Magento which Collection to use for displaying in the grid.
         */
        $collection = Mage::getResourceModel(
            'ap_modbanners/banner_collection'
        );
        $this->setCollection($collection);
        
        return parent::_prepareCollection();
    }
    
    public function getRowUrl($row)
    {
        /**
         * When a grid row is clicked, this is where the user should
         * be redirected to. In our example, the method editAction of 
         * bannerController.php in bannerDirectory module.
         */
        return $this->getUrl(
            'ap_modbanners_admin/banner/edit',
            array(
                'id' => $row->getId()
            )
        );
    }

    protected function _prepareColumns()
    {
        /**
         * Here we define which columns we want to be displayed in the grid.
         */
       /* $this->addColumn('entity_id', array(
            'header' => $this->_getHelper()->__('ID'),
            'type' => 'number',
            'index' => 'entity_id',
        ));     */
        

        
        $this->addColumn('title', array(
            'header' => $this->_getHelper()->__('Title'),
            'type' => 'text',
            'index' => 'title',
        ));

      
         $this->addColumn('start_date', array(
            'header' => $this->_getHelper()->__('Start date'),
            'type' => 'date',
            'index' => 'start_date',
        ));
        
        $this->addColumn('end_date', array(
            'header' => $this->_getHelper()->__('End date'),
            'type' => 'date',
            'index' => 'end_date',
        ));
        
        /**
         * Finally we add an action column with an edit link.
         */
        $this->addColumn('action', array(
            'header' => $this->_getHelper()->__('Action'),
            'width' => '50px',
            'type' => 'action',
            'actions' => array(
                array(
                    'caption' => $this->_getHelper()->__('Edit'),
                    'url' => array(
                        'base' => 'ap_modbanners_admin'
                                  . '/banner/edit',
                    ),
                    'field' => 'id'
                ),
            ),
            'filter' => false,
            'sortable' => false,
            'index' => 'entity_id',
        ));
        
        return parent::_prepareColumns();
    }
    
    protected function _getHelper()
    {
        return Mage::helper('ap_modbanners');
    }
}
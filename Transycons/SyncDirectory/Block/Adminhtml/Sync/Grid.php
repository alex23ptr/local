<?php
class Transycons_SyncDirectory_Block_Adminhtml_Sync_Grid
    extends Mage_Adminhtml_Block_Widget_Grid
{
    protected function _prepareCollection()
    {
        /**
         * Tell Magento which Collection to use for displaying in the grid.
         */
        $collection = Mage::getResourceModel(
            'transycons_syncdirectory/sync_collection'
        );
        $this->setCollection($collection);
        
        return parent::_prepareCollection();
    }
    
    public function getRowUrl($row)
    {
        /**
         * When a grid row is clicked, this is where the user should
         * be redirected to. In our example, the method editAction of 
         * syncController.php in syncDirectory module.
         */
        return $this->getUrl(
            'transycons_syncdirectory_admin/sync/edit',
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
        

        
        $this->addColumn('regius_id', array(
            'header' => $this->_getHelper()->__('Regius Id'),
            'type' => 'number',
            'index' => 'regius_id',
        ));

          $this->addColumn('emag_id', array(
            'header' => $this->_getHelper()->__('Emag Id'),
            'type' => 'number',
            'index' => 'emag_id',
        ));
         $this->addColumn('name', array(
            'header' => $this->_getHelper()->__('Name'),
            'type' => 'text',
            'index' => 'name',
        ));
         $this->addColumn('product_sku', array(
            'header' => $this->_getHelper()->__('SKU'),
            'type' => 'text',
            'index' => 'product_sku',
        ));
        
        $this->addColumn('qty', array(
            'header' => $this->_getHelper()->__('Cantitate'),
            'type' => 'number',
            'index' => 'qty',
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
                        'base' => 'transycons_syncdirectory_admin'
                                  . '/sync/edit',
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
        return Mage::helper('transycons_syncdirectory');
    }
}
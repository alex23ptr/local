<?php
class AP_ModBanners_Model_Resource_Banner
    extends Mage_Core_Model_Resource_Db_Abstract
{
    protected function _construct()
    {
        /**
         * Tell Magento the database name and primary key field to persist 
         * data to. Similar to the _construct() of our Model, Magento finds 
         * this data from config.xml by finding the <resourceModel/> node 
         * and locating children of <entities/>.
         * 
         *  
         */ 
        $this->_init('ap_modbanners/banner', 'entity_id');
		  
    }
}
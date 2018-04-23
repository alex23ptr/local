<?php
class Transycons_SyncDirectory_Model_Resource_Sync
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
         * In this example:
         * - transycons_syncdirectory is the Model alias
         * - sync is the entity referenced in config.xml
         * - entity_id is the name of the primary key column
         * 
         * As a result Magento will write data to the table 
         * 'transycons_syncdirectory_sync' and any calls to
         * $model->getId() will retrieve the data from the column 
         * named 'entity_id'.
         */
        $this->_init('transycons_syncdirectory/sync', 'entity_id');
    }
}
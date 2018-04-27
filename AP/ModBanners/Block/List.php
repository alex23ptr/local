<?php
class AP_ModBanners_Block_List extends Mage_Core_Block_Template
{
	
	
    public function getBannersCollection()
    {
        $collection =  Mage::getModel('ap_modbanners/banner')->getCollection()
			->setPageSize(5) //set limit
            ->addFieldToFilter('start_date', array('lt' => date('Y-m-d H:i:s'))  ) //date_start < today
            ->addFieldToFilter('end_date', array('gteq' => date('Y-m-d H:i:s'))  ) //date_en >= today
            ->setOrder('title', 'ASC');
		//echo $collection->getSelect();
		return $collection;
    }
}
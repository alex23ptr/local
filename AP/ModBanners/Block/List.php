<?php
class AP_ModBanners_Block_List extends Mage_Core_Block_Template
{
    public function getBannersCollection()
    {
        return Mage::getModel('ap_modbanners/banner')->getCollection()
          //  ->addFieldToFilter('start_date', date('Y-m-d') )
            ->setOrder('title', 'ASC');
    }
}
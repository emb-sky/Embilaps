<?php

namespace Emb\Module\Plugin;

use Emb\Module\Model\Sample;

class ApplyShipping
{

     /**
     * @var $model
     */
    protected $_model;
    

    public function __construct(Sample $model) 
    {
        $this->_model = $model;
    }

    public function aroundCollectCarrierRates(
        \Magento\Shipping\Model\Shipping $subject,
        \Closure $proceed,
        $carrierCode,
        $request
    )
    {
        // $pincode=560015;
      $collection = $this->_model->getCollection()
   ->addFieldToFilter('pincode',array('eq' => $pincode))
   ->addFieldToFilter('enable', array('eq' => "Yes"));

   $count = $collection->getData();


            // Enter Shipping Code here instead of 'freeshipping'
        if ($carrierCode == 'freeshipping' && count($count) == 0) {
           // To disable the shipping method return false
            return false;
        } 
           // To enable the shipping method
            return $proceed($carrierCode, $request);
    }
}

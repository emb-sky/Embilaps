<?php
namespace Embilaps\Embilaps\Observer;

use Magento\Framework\DataObject;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Payment\Helper\Data as paymentData;
use Magento\Payment\Model\Method\AbstractMethod;
use Magento\Quote\Api\Data\CartInterface;
use Magento\OfflinePayments\Model\Cashondelivery;

class DisableCashOnDelivery implements ObserverInterface
{
    public function execute(Observer $observer)
    {
        //$quote = $observer->getEvent()->getQuote();
       //echo $quote->getId();
       //die();
         /** @var DataObject $result */

         $result = $observer->getResult();
         /** @var AbstractMethod $methodInstance */

         $methodInstance = $observer->getMethodInstance();
         /** @var CartInterface $quote */


         $paymentCode = $methodInstance->getCode();


         $quote = $observer->getEvent()->getQuote();
         if ($quote && $quote->getId()) 
         {
            
            if($paymentCode === Cashondelivery::PAYMENT_METHOD_CASHONDELIVERY_CODE){
                $items=$quote->getAllItems();
                foreach($items as $item){
                $product = \Magento\Framework\App\ObjectManager::getInstance() ->create(\Magento\Catalog\Model\Product::class)->load($item->getProductId()); 
                $attributeValue = $product->getData('cod_enable');
                //print_r($attributeValue);
                //die();
                
                if($attributeValue){
                $result->setData('is_available', false);
                break;
                }
            }
            }
            }
         }
     }
        
       



<?php
namespace Embilaps\Embilaps\Observer; 

use Magento\Framework\Event\ObserverInterface; 
use Magento\Framework\Event\Observer; 
use Magento\Customer\Model\CustomerFactory; 
use Magento\Sales\Model\OrderFactory; 

class DisableCodForCust implements ObserverInterface
{ 
    protected $customerFactory; 
    protected $orderFactory; 
    public function __construct( CustomerFactory $customerFactory, OrderFactory $orderFactory )
     { 
        $this->customerFactory = $customerFactory; 
        $this->orderFactory = $orderFactory;
     } 
    public function execute(Observer $observer) 
    { 
        $order = $observer->getEvent()->getOrder(); 
        $payment = $order->getPayment(); 
        if ($payment->getMethod() == 'cashondelivery' && $order->getState() == 'canceled') 
        { 
            $customerId = $order->getCustomerId(); 
            $customer = $this->customerFactory->create()->load($customerId); 
            $customer->setData('cust_cod_enable', '0'); 
            
            $customer->save(); 
        }
     }
}
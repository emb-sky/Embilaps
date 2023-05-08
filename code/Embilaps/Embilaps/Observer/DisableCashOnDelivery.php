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
use Magento\Customer\Model\CustomerFactory;
use Magento\Catalog\Model\ProductFactory;

class DisableCashOnDelivery implements ObserverInterface
{
    protected $customerFactory;
    protected $productFactory;

    public function __construct(
        CustomerFactory $customerFactory,
        ProductFactory $productFactory
    ) {
        $this->customerFactory = $customerFactory;
        $this->productFactory = $productFactory;
    }

    public function execute(Observer $observer)
    {
        /** @var DataObject $result */
        $result = $observer->getResult();
        
        /** @var AbstractMethod $methodInstance */
        $methodInstance = $observer->getMethodInstance();
        
        /** @var CartInterface $quote */
        $quote = $observer->getEvent()->getQuote();
        
        if ($quote && $quote->getId()) {
            $paymentCode = $methodInstance->getCode();
            
            if ($paymentCode === Cashondelivery::PAYMENT_METHOD_CASHONDELIVERY_CODE) {
                $items = $quote->getAllItems();
                
                foreach ($items as $item) {
                    $product = $this->productFactory->create()->load($item->getProductId());
                    $attributeValue = $product->getData('cod_enable');
                    
                    if ($attributeValue) {
                        $result->setData('is_available', false);
                        break;
                    }
                }
                
                $customerId = $quote->getCustomerId();
                $customer = $this->customerFactory->create()->load($customerId);
                
                if ($customer->getCustCodEnable()) {
                    $result->setData('is_available', false);
                }
            }
        }
    }
}

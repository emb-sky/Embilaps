<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Embilaps\Embilaps\Model\Data;

use \Magento\Framework\Api\AttributeValueFactory;

/**
 * Customer data model
 *
 * @SuppressWarnings(PHPMD.ExcessivePublicCount)
 */
class Customer extends \Magento\Customer\Model\Data\Customer 
{
    const CUST_COD_ENABLE='cust_cod_enable';
    /**
 * Get Cust_Cod_Enable
 * 
 * @return string
 */
public function getCustCodEnable()
{
    return $this->_get(self::CUST_COD_ENABLE);
}
public function setCustCodEnable($cod)
{
    return $this->setData(self::CUST_COD_ENABLE,$cod);
}

}
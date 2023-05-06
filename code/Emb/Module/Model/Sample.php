<?php 
namespace Emb\Module\Model;
use Magento\Framework\Model\AbstractModel;

class Sample extends AbstractModel
{
    protected function _construct()
    {
        $this->_init('Emb\Module\Model\ResourceModel\Sample');
    }
}

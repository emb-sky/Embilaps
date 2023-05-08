<?php
namespace Emb\Module\Model\ResourceModel;

class Sample extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('ui_module', 'id');
    }
}

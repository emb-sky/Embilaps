<?php
namespace Emb\Module\Model\ResourceModel\Sample;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;



class Collection extends AbstractCollection
{
    /**
     
     * @var string
     */
    protected $id_fieldname='id';
    
    protected function _construct()
    {
        $this->_init(
            'Emb\Module\Model\Sample',
            'Emb\Module\Model\ResourceModel\Sample'

        );
    }
    
}
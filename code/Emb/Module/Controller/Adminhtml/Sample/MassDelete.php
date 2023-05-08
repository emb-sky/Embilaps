<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Emb\Module\Controller\Adminhtml\Sample;

use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Backend\App\Action\Context;
use Magento\Ui\Component\MassAction\Filter;
use Emb\Module\Model\ResourceModel\Sample\CollectionFactory;

/**
 * Class MassDelete
 */
class MassDelete extends \Magento\Backend\App\Action implements HttpPostActionInterface
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Emb_Module::sample_delete';

    /**
     * @var Filter
     */
    protected $filter;

    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @param Context $context
     * @param Filter $filter
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(Context $context, Filter $filter, CollectionFactory $collectionFactory)
    {
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context);
    }

    /**
     * Execute action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     * @throws \Magento\Framework\Exception\LocalizedException|\Exception
     */
    public function execute()
    {
        $collection = $this->filter->getCollection($this->collectionFactory->create());
        $collectionSize = $collection->getSize();

        foreach ($collection as $sample) {
            $sample->delete();
        }

        $this->messageManager->addSuccessMessage(__('A total of %1 record(s) have been deleted.', $collectionSize));

        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        
        return $resultRedirect->setPath('*/*/');
    }
}


// namespace Emb\Module\Controller\Adminhtml\Sample;

// use Magento\Backend\App\Action\Context;
// use Magento\Ui\Component\MassAction\Filter;
// use Emb\Module\Model\ResourceModel\Sample\CollectionFactory;
// use Magento\Framework\Controller\ResultFactory;
// use Magento\Framework\App\ResponseInterface;

// class MassDelete extends \Magento\Backend\App\Action
// {
//     /**
//      * @var Filter
//      */
//     protected $filter;

//     /**
//      * @var CollectionFactory
//      */
//     protected $collectionFactory;

//     /**
//      * @param Context $context
//      * @param Filter $filter
//      * @param CollectionFactory $collectionFactory
//      */
//     public function __construct(Context $context, Filter $filter, CollectionFactory $collectionFactory)
//     {
//         $this->filter = $filter;
//         $this->collectionFactory = $collectionFactory;
//         parent::__construct($context);
//     }

//     /**
//      * Dispatch request
//      *
//      * @return \Magento\Framework\Controller\ResultInterface|ResponseInterface
//      * @throws \Magento\Framework\Exception\NotFoundException
//      */
//     public function execute()
//     {
//         $collection = $this->filter->getCollection($this->collectionFactory->create());
//         $collectionSize = $collection->getSize();

//         foreach ($collection as $item) {
//             $item->delete();
//         }

//         $this->messageManager->addSuccess(__('A total of %1 element(s) have been deleted.', $collectionSize));

//         /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
//         $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
//         return $resultRedirect->setPath('*/*/');
//     }
// }

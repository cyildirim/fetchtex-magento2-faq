<?php


namespace Fetchtex\FAQs\Controller\Adminhtml\Faqs;


use Fetchtex\FAQs\Model\Faq;
use Fetchtex\FAQs\Model\FaqFactory;
use Fetchtex\FAQs\Model\ResourceModel\Faq\Collection;
use Fetchtex\FAQs\Model\ResourceModel\Faq\CollectionFactory;
use Magento\Backend\App\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Setup\Exception;

class Remove extends Action
{

    /**
     * @var CollectionFactory
     */
    private $faqCollectionFactory;

    public function __construct( Context $context, CollectionFactory $faqCollectionFactory, FaqFactory $faqFactory )
    {
        parent::__construct($context);
        $this->faqCollectionFactory = $faqCollectionFactory;
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Fetchtex_FAQs::listing');
    }

    /**
     * Execute action based on request and return result
     *
     * Note: Request will be added as operation argument in future
     *
     * @return \Magento\Framework\Controller\ResultInterface|ResponseInterface
     * @throws \Magento\Framework\Exception\NotFoundException
     */
    public function execute()
    {
        $params = $this->getRequest()->getParams();

        /**
         * @var Collection $faqCollection
         */
        $faqCollection = $this->faqCollectionFactory->create();

        try {
            $faqCollection->deleteById($params['entity_id']);
            $this->messageManager->addSuccessMessage("Faq has been successfully removed");
        } catch (\Exception $exception) {
            $this->messageManager->addErrorMessage("An Error Occured");

        }

        return $this->_redirect("*/faqs/index");
    }
}
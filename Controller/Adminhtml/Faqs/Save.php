<?php


namespace Fetchtex\FAQs\Controller\Adminhtml\Faqs;

use Fetchtex\FAQs\Model\Faq;
use Magento\Backend\App\Action;
use Magento\Framework\App\ResponseInterface;
use Fetchtex\FAQs\Model\FaqFactory;

class Save extends Action
{

    /**
     * @var FaqFactory
     */
    private $faqFactory;

    public function __construct( Action\Context $context, FaqFactory $faqFactory )
    {
        parent::__construct($context);
        $this->faqFactory = $faqFactory;
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Fetchtex_FAQs::listing');
    }

    public function execute()
    {
        $params = $this->getRequest()->getParams();
        try {

            /**
             * @var Faq $faq
             */
            $faq = $this->faqFactory->create();

            if (array_key_exists('entity_id', $params)) {
                $faq->setEntityId($params['entity_id']);
            }
            $faq->setQuestion($params['question']);
            $faq->setAnswer($params['answer']);
            $faq->setCategoryId($params['category_id']);
            $faq->save();
            $this->messageManager->addSuccessMessage("FAQ is successfully added");
        } catch (\Exception $e) {
            print_r($e->getTraceAsString());
            exit();
            $this->messageManager->addErrorMessage("FAQ cannot be added, please try again later");
        }
        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setPath('*/*/index');
        return $resultRedirect;


    }
}
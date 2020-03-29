<?php


namespace Fetchtex\FAQs\Controller\Adminhtml\Faqs;


use Fetchtex\FAQs\Model\Faq;
use Magento\Backend\App\Action;
use Magento\Framework\App\ResponseInterface;

class Edit extends Action
{

    protected $resultPageFactory = false;
    /**
     * @var \Fetchtex\FAQs\Model\FaqFactory
     */
    private $faqFactory;

    public function __construct(
        Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Fetchtex\FAQs\Model\FaqFactory $faqFactory
    )
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->faqFactory = $faqFactory;
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
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend((__('Create FAQ')));
        $params = $this->getRequest()->getParams();
        /**
         * @var Faq $faq
         */
        $faq = $this->faqFactory->create();

        if ($params['entity_id']) {
            $faqModel = $faq->load($params['entity_id']);
        }

        return $resultPage;
    }
}
<?php

namespace Fetchtex\FAQs\Controller\Adminhtml\Category;

use Fetchtex\FAQs\Model\FaqCategory;
use Fetchtex\FAQs\Model\FaqCategoryFactory;
use Fetchtex\FAQs\Model\ResourceModel\FaqCategory as ResourceModel;;
use Magento\Backend\App\Action;
use Magento\Framework\App\ResponseInterface;

class Save extends Action
{
    /**
     * @var ResourceModel
     */
    private $faqCategoryResourceModel;
    /**
     * @var FaqCategoryFactory
     */
    private $faqCategoryFactory;

    public function __construct( Action\Context $context, ResourceModel $faqCategoryResourceModel, FaqCategoryFactory $faqCategoryFactory )
    {
        parent::__construct($context);
        $this->faqCategoryResourceModel = $faqCategoryResourceModel;
        $this->faqCategoryFactory = $faqCategoryFactory;
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
        try {
            $params = $this->getRequest()->getParams();
            /**
             * @var $faqCategory FaqCategory
             */
            $faqCategory = $this->faqCategoryFactory->create();

            $faqCategory->setName($params['name']);
            $this->faqCategoryResourceModel->save($faqCategory);

            $this->messageManager->addSuccessMessage("FAQ Category is successfully added");
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage("FAQ Category cannot be added, please try again later");
        }

        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setPath('*/*/index');
        return $resultRedirect;
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Fetchtex_FAQs::listing');
    }
}

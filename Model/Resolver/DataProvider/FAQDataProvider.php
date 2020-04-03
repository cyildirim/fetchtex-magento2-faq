<?php


namespace Fetchtex\FAQs\Model\Resolver\DataProvider;

use Fetchtex\FAQs\Model\Api\FaqInterface;
use Fetchtex\FAQs\Model\Faq;
use Fetchtex\FAQs\Model\FaqFactory;
use Magento\CatalogGraphQl\Model\Resolver\Products\DataProvider\Product\CollectionProcessorInterface;

class FAQDataProvider
{
    /**
     * @var FaqFactory
     */
    private $faqFactory;

    public function __construct( FaqFactory $faqFactory )
    {
        $this->faqFactory = $faqFactory;
    }


    public function getData( int $id ): array
    {
        /**
         * @var Faq $faq
         */
        $faq = $this->faqFactory->create();

        $faq->load($id);

        $pageData = [
            FaqInterface::ID => $faq->getId(),
            FaqInterface::ANSWER => $faq->getAnswer(),
            FaqInterface::QUESTION => $faq->getQuestion(),
            FaqInterface::CATEGORY_ID => $faq->getCategoryId()
        ];

        return $pageData;
    }

}
<?php


namespace Fetchtex\FAQs\Model\Resolver\DataProvider;


use Fetchtex\FAQs\Model\Api\FaqInterface;
use Fetchtex\FAQs\Model\ResourceModel\Faq\Collection;

class FAQListDataProvider
{

    /**
     * @var Collection $faqCollection
     */
    private $faqCollection;

    public function __construct( \Fetchtex\FAQs\Model\ResourceModel\Faq\CollectionFactory $faqCollectionFactory )
    {
        $this->faqCollection = $faqCollectionFactory->create();
    }

    public function getData()
    {
        $items = [];

        foreach ($this->faqCollection->getData() as $item) {
            $items[] = [
                FaqInterface::ID => $item['entity_id'],
                FaqInterface::QUESTION => $item['question'],
                FaqInterface::ANSWER => $item['answer'],
                FaqInterface::CATEGORY_ID => $item['category_id'],
            ];
        }

        $result = [
            "items" => $items,
            "total_count" => count($items)
        ];

        return $result;
    }
}
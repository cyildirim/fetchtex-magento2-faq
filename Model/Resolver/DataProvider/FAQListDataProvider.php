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

    public function getData( $question = null, $categoryId = null )
    {

        $this->faqCollection->joinFaqCategory();

        if (isset($categoryId)) {
            $this->faqCollection->addCategoryIdFilter($categoryId);
        }

        if (isset($question)) {
            $this->faqCollection->addQuestionFilter($question);
        }

        $items = [];

        foreach ($this->faqCollection->getData() as $item) {
            $items[] = [
                FaqInterface::ID => $item['entity_id'],
                FaqInterface::QUESTION => $item['question'],
                FaqInterface::ANSWER => $item['answer'],
                "category" => [
                    "id" =>$item['category_id'],
                    "name" =>$item['category_name']
                ],
            ];
        }

        $result = [
            "items" => $items,
            "total_count" => count($items)
        ];

        return $result;
    }
}

<?php


namespace Fetchtex\FAQs\Model;

use Fetchtex\FAQs\Model\ResourceModel\Faq\Collection;
use Fetchtex\FAQs\Model\ResourceModel\Faq\CollectionFactory;

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * @var array
     */
    protected $_loadedData;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $faqCollectionFactory,
        array $meta = [],
        array $data = []
    )
    {

        $this->collection = $faqCollectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData()
    {
        /**
         * @var Collection $faqCollection
         */
        $faqCollection = $this->collection;


        $items = $faqCollection->joinFaqCategory()->getItems();

        $itemArray = [];
        foreach ($items as $item) {
            $itemArray[] = $item->toArray();
        }
        $dataProvider = [
            'items' => $itemArray,
            'totalRecords' => sizeof($items)
        ];

        return $dataProvider;
    }

}
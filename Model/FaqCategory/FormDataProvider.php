<?php


namespace Fetchtex\FAQs\Model\FaqCategory;


use Fetchtex\FAQs\Model\ResourceModel\FaqCategory\Collection;
use Fetchtex\FAQs\Model\ResourceModel\FaqCategory\CollectionFactory;

class FormDataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * @var array
     */
    protected $_loadedData;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $faqCategoryCollectionFactory,
        array $meta = [],
        array $data = []
    )
    {

        $this->collection = $faqCategoryCollectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData()
    {
        /**
         * @var Collection $faqCategoryCollection
         */
        $faqCategoryCollection = $this->collection;
        $item = $faqCategoryCollection->getFirstItem();


        $this->_loadedData[$item->getId()] = $item->getData();

        return $this->_loadedData;
    }

}

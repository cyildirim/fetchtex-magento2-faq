<?php


namespace Fetchtex\FAQs\Model;

use Fetchtex\FAQs\Model\ResourceModel\Faq\Collection;
use Fetchtex\FAQs\Model\ResourceModel\Faq\CollectionFactory;

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
        $item = $faqCollection->getFirstItem();


        $this->_loadedData[$item->getId()] = $item->getData();

        return $this->_loadedData;
    }


}
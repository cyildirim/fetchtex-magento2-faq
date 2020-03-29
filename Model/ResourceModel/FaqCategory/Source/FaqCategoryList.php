<?php


namespace Fetchtex\FAQs\Model\ResourceModel\FaqCategory\Source;

use Fetchtex\FAQs\Model\FaqCategory;
use Fetchtex\FAQs\Model\ResourceModel\FaqCategory\Collection;
use Magento\Framework\Data\OptionSourceInterface;
use \Fetchtex\FAQs\Model\ResourceModel\FaqCategory\CollectionFactory;

class FaqCategoryList implements OptionSourceInterface
{

    /**
     * @var CollectionFactory
     */
    private $faqCategoryCollectionFactory;

    public function __construct( CollectionFactory $faqCategoryCollectionFactory )
    {
        $this->faqCategoryCollectionFactory = $faqCategoryCollectionFactory;
    }

    /**
     * Return array of options as value-label pairs
     *
     * @return array Format: array(array('value' => '<value>', 'label' => '<label>'), ...)
     */
    public function toOptionArray()
    {
        /** @var Collection $collection */
        $collection = $this->faqCategoryCollectionFactory->create();

        $options[] = ['label' => 'Default', 'value' => ''];

        /**
         * @var FaqCategory $category
         */
        foreach ($collection->getItems() as $category) {
            $options[] = ['label' => $category->getName(), 'value' => $category->getId()];
        }

        return $options;
    }
}
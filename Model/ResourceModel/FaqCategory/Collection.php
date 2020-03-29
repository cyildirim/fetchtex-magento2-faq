<?php


namespace Fetchtex\FAQs\Model\ResourceModel\FaqCategory;


use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'entity_id';
    protected $_eventPrefix = 'fetchtex_faq_faq_category_collection';
    protected $_eventObject = 'faq_category_collection';


    protected function _construct()
    {
        $this->_init(\Fetchtex\FAQs\Model\FaqCategory::class,
            \Fetchtex\FAQs\Model\ResourceModel\FaqCategory::class);
    }


}
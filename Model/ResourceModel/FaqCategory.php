<?php


namespace Fetchtex\FAQs\Model\ResourceModel;


class FaqCategory extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init("fetchtex_faq_category", "entity_id");
    }
}
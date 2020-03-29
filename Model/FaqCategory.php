<?php


namespace Fetchtex\FAQs\Model;


use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;

class FaqCategory extends AbstractModel implements IdentityInterface
{

    const CACHE_TAG = "fetchtex_faq_category";

    protected $_cacheTag = 'fetchtex_faq_faq_category';

    protected $_eventPrefix = 'fetchtex_faq_faq_category';

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }
}
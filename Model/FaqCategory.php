<?php

namespace Fetchtex\FAQs\Model;

use Fetchtex\FAQs\Model\Api\FaqCategoryInterface;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;

class FaqCategory extends AbstractModel implements IdentityInterface, FaqCategoryInterface
{
    const CACHE_TAG = "fetchtex_faq_category";

    protected $_cacheTag = 'fetchtex_faq_faq_category';

    protected $_eventPrefix = 'fetchtex_faq_faq_category';

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getName()
    {
        return $this->_getData(self::NAME);
    }

    public function setName( $name )
    {
        return $this->setData(self::NAME, $name);
    }

    public function getThumbnail()
    {
        return $this->getData(self::THUMBNAIL);
    }

    public function setThumbnail( $thumbnail )
    {
        return $this->setData(self::THUMBNAIL, $thumbnail);
    }
}

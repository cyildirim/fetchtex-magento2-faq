<?php

namespace Fetchtex\FAQs\Model;

use Fetchtex\FAQs\Model\Api\FaqInterface;
use Magento\Framework\DataObject\IdentityInterface;

class Faq extends \Magento\Framework\Model\AbstractModel implements IdentityInterface, FaqInterface
{

    const CACHE_TAG = "fetchtex_faq";

    protected $_cacheTag = 'fetchtex_faq_faq';

    protected $_eventPrefix = 'fetchtex_faq_faq';

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getAnswer()
    {
        return $this->getData(self::ANSWER);
    }

    public function setAnswer( $answer )
    {
        return $this->setData(self::ANSWER, $answer);
    }

    public function getQuestion()
    {
        return $this->getData(self::QUESTION);
    }

    public function setQuestion( $question )
    {
        return $this->setData(self::QUESTION, $question);
    }

    public function getCategoryId()
    {
        return $this->getData(self::CATEGORY_ID);
    }

    public function setCategoryId( $categoryId )
    {
        return $this->setData(self::CATEGORY_ID, $categoryId);
    }
}
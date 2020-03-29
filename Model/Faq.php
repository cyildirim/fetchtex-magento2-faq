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
        return $this->getData('answer');
    }

    public function setAnswer( $answer )
    {
        return $this->setData('answer', $answer);
    }

    public function getQuestion()
    {
        return $this->getData('question');
    }

    public function setQuestion( $question )
    {
        return $this->setData('question', $question);
    }

    public function getCategoryId()
    {
        return $this->getData('category_id');
    }

    public function setCategoryId( $categoryId )
    {
        return $this->setData('category_id', $categoryId);
    }
}
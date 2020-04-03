<?php


namespace Fetchtex\FAQs\Model\Resolver\FAQ;


use Fetchtex\FAQs\Model\Api\FaqInterface;
use Magento\Framework\GraphQl\Query\Resolver\IdentityInterface;

class Identity implements IdentityInterface
{

    /**
     * @var string
     */
    private $cacheTag = \Fetchtex\FAQs\Model\Faq::CACHE_TAG;

    /**
     * @param array $resolvedData
     * @return array
     */
    public function getIdentities( array $resolvedData ): array
    {
        return empty($resolvedData[FaqInterface::ID]) ?
            [] : [$this->cacheTag, sprintf('%s_%s', $this->cacheTag, $resolvedData[FaqInterface::ID])];
    }
}
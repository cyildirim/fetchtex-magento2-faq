<?php


namespace Fetchtex\FAQs\Model\Resolver\FAQ;


use Fetchtex\FAQs\Model\Api\FaqInterface;
use Fetchtex\FAQs\Model\Faq;
use Magento\Cms\Api\Data\BlockInterface;
use Magento\Framework\GraphQl\Query\Resolver\IdentityInterface;

class FAQListIdentity implements IdentityInterface
{

    /** @var string */
    private $cacheTag = 'faq_list';

    /**
     * Get identity tags from resolved data.
     *
     * Example: identityTag, identityTag_UniqueId.
     *
     * @param array $resolvedData
     * @return string[]
     */
    public function getIdentities( array $resolvedData ): array
    {
        $ids = [];
        $items = $resolvedData['items'] ?? [];
        foreach ($items as $item) {
            if (is_array($item) && !empty($item[FaqInterface::ID])) {
                $ids[] = sprintf('%s_%s', $this->cacheTag, $item[FaqInterface::ID]);
            }
        }

        if (!empty($ids)) {
            array_unshift($ids, $this->cacheTag);
        }

        return $ids;
    }
}

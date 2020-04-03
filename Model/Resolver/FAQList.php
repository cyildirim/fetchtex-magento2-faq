<?php


namespace Fetchtex\FAQs\Model\Resolver;


use Fetchtex\FAQs\Model\Resolver\DataProvider\FAQListDataProvider;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\Resolver\ContextInterface;
use Magento\Framework\GraphQl\Query\Resolver\Value;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;

class FAQList implements ResolverInterface
{
    /**
     * @var DataProvider\FAQListDataProvider
     */
    private $dataProvider;

    public function __construct( FAQListDataProvider $dataProvider)
    {
        $this->dataProvider = $dataProvider;
    }

    /**
     * Fetches the data from persistence models and format it according to the GraphQL schema.
     *
     * @param \Magento\Framework\GraphQl\Config\Element\Field $field
     * @param ContextInterface $context
     * @param ResolveInfo $info
     * @param array|null $value
     * @param array|null $args
     * @return mixed|Value
     * @throws \Exception
     */
    public function resolve( Field $field, $context, ResolveInfo $info, array $value = null, array $args = null )
    {
        return $this->dataProvider->getData();
    }
}
<?php


namespace Fetchtex\FAQs\Model\Resolver;


use Fetchtex\FAQs\Model\Resolver\DataProvider\FAQDataProvider;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Exception\GraphQlInputException;
use Magento\Framework\GraphQl\Query\Resolver\ContextInterface;
use Magento\Framework\GraphQl\Query\Resolver\Value;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magento\Framework\GraphQl\Query\Resolver\Argument\SearchCriteria\Builder;

class FAQ implements ResolverInterface
{

    /**
     * @var FAQDataProvider
     */
    private $dataProvider;
    /**
     * @var Builder
     */
    private $searchCriteriaBuilder;

    public function __construct( FAQDataProvider $dataProvider, Builder $searchCriteriaBuilder )
    {
        $this->dataProvider = $dataProvider;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
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
        $faqId = $this->getFaqId($args);
        return $this->dataProvider->getData($faqId);
    }


    /**
     * @param array $args
     * @return int
     * @throws GraphQlInputException
     */
    private function getFaqId( array $args ): int
    {
        if (!isset($args['id'])) {
            throw new GraphQlInputException(__('"Page id should be specified'));
        }

        return (int)$args['id'];
    }
}
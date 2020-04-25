<?php


namespace Fetchtex\FAQs\Model\Resolver;


use Fetchtex\FAQs\Model\Resolver\DataProvider\FAQListDataProvider;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\Resolver\Argument\SearchCriteria\Builder;
use Magento\Framework\GraphQl\Query\Resolver\Argument\SearchCriteria\SearchFilter;
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
    /**
     * @var Builder
     */
    private $searchCriteriaBuilder;
    /**
     * @var SearchFilter
     */
    private $searchFilter;

    public function __construct( FAQListDataProvider $dataProvider, Builder $searchCriteriaBuilder, SearchFilter $searchFilter )
    {
        $this->dataProvider = $dataProvider;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->searchFilter = $searchFilter;
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
        $filter = $args["filter"];

        $question = array_key_exists("question", $filter) ? $filter["question"] : null;
        $categoryId = array_key_exists("category_id", $filter) ? $filter["category_id"] : null;

        return $this->dataProvider->getData($question, $categoryId);
    }


}
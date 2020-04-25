<?php

namespace Fetchtex\FAQs\Model\ResourceModel\Faq;

use Fetchtex\FAQs\Model\Faq;
use Fetchtex\FAQs\Model\FaqFactory;
use Fetchtex\FAQs\Model\FaqCategory;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'entity_id';
    protected $_eventPrefix = 'fetchtex_faq_faq_collection';
    protected $_eventObject = 'faq_collection';
    /**
     * @var FaqFactory
     */
    private $faqFactory;


    protected function _construct()
    {
        $this->_init(\Fetchtex\FAQs\Model\Faq::class, \Fetchtex\FAQs\Model\ResourceModel\Faq::class);
    }

    public function __construct(
        \Magento\Framework\Data\Collection\EntityFactoryInterface $entityFactory,
        \Psr\Log\LoggerInterface $logger,
        \Magento\Framework\Data\Collection\Db\FetchStrategyInterface $fetchStrategy,
        \Magento\Framework\Event\ManagerInterface $eventManager,
        \Magento\Framework\DB\Adapter\AdapterInterface $connection = null,
        \Magento\Framework\Model\ResourceModel\Db\AbstractDb $resource = null,
        FaqFactory $faqFactory )
    {
        parent::__construct($entityFactory, $logger, $fetchStrategy, $eventManager, $connection, $resource);
        $this->faqFactory = $faqFactory;
    }

    public function joinFaqCategory()
    {
        return $this->join(['ffc' => 'fetchtex_faq_category'], 'ffc.entity_id=main_table.category_id', ['category_name' => 'name', 'category_id' => 'ffc.entity_id']);
    }

    public function addQuestionFilter( $question )
    {
        return $this->addFieldToFilter("question", ["like" => $question]);
    }

    public function addCategoryIdFilter( $category_id )
    {
        return $this->addFieldToFilter("category_id", ["eq" => $category_id]);
    }

    /**
     * @param $id
     */
    public function deleteById( $id )
    {

        try {
            /**
             * @var Faq $faq
             */
            $faq = $this->faqFactory->create();
            $faq->setEntityId($id);

            $this->getResource()->delete($faq);
        } catch (\Exception $e) {
            $this->_logger->error($e->getMessage() . $e->getTraceAsString());
        }
    }

}
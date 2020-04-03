<?php

namespace Fetchtex\FAQs\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Faq extends AbstractDb
{

    const MAIN_TABLE = 'fetchtex_faq';

    protected function _construct()
    {
        $this->_init(self::MAIN_TABLE, "entity_id");
    }

}
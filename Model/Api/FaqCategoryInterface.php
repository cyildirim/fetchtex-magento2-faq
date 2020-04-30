<?php

namespace Fetchtex\FAQs\Model\Api;

interface FaqCategoryInterface
{
    const ID = 'entity_id';
    const NAME = 'name';
    const THUMBNAIL = 'thumbnail';

    public function getName();

    public function setName($name);

    public function getThumbnail();

    public function setThumbnail($thumbnail);
}

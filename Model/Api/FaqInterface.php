<?php


namespace Fetchtex\FAQs\Model\Api;


interface FaqInterface
{
    const ID = 'entity_id';
    const QUESTION = 'question';
    const ANSWER = 'answer';
    const CATEGORY_ID = 'category_id';

    /**
     * @return string
     */
    public function getAnswer();

    /**
     * @param string $answer
     * @return $this
     */
    public function setAnswer( $answer );

    /**
     * @return string
     */
    public function getQuestion();

    /**
     * @param string $question
     * @return $this
     */
    public function setQuestion( $question );

    /**
     * @return int
     */
    public function getCategoryId();

    /**
     * @param int $categoryId
     * @return $this
     */
    public function setCategoryId( $categoryId );

}
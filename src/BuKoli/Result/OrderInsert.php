<?php
namespace BuKoli\Result;

/**
 * @author      Zeki Unal <zekiunal@gmail.com>
 * @description
 *
 * @package     BuKoli\Result
 * @name        OrderInsert
 * @version     0.1
 * @created     2015/10/31 22:47
 */
class OrderInsert extends AbstractResult
{
    /**
     * @var int
     */
    protected $tracking_number;

    /**
     * @var int
     */
    protected $token_order_id;

    /**
     *
     * @param \stdClass $result
     */
    public function __construct(\stdClass $result)
    {
        $this->bind($result);
    }

    /**
     * @return int
     */
    public function getTrackingNumber()
    {
        return $this->tracking_number;
    }

    /**
     * @param int $tracking_number
     */
    public function setTrackingNumber($tracking_number)
    {
        $this->tracking_number = $tracking_number;
    }

    /**
     * @return int
     */
    public function getTokenOrderId()
    {
        return $this->token_order_id;
    }

    /**
     * @param int $token_order_id
     */
    public function setTokenOrderId($token_order_id)
    {
        $this->token_order_id = $token_order_id;
    }

    /**
     * @param \stdClass $result
     *
     * @return $this
     */
    public function bind($result)
    {
        $this->setTokenOrderId($result->OrderInsertResult->JetonOrderId);
        $this->setStatus($result->OrderInsertResult->Status);
        $this->setMessage($result->OrderInsertResult->Message);
        $this->setTrackingNumber($result->OrderInsertResult->TrackingNo);
        return $this;
    }
}

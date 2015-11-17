<?php
namespace BuKoli\Result;

/**
 * @author      Zeki Unal <zekiunal@gmail.com>
 * @description
 *
 * @package     BuKoli\Result
 * @name        AbstractResult
 * @version     0.1
 * @created     2015/10/28 15:00
 */
abstract class AbstractResult
{
    /**
     * @var int
     */
    protected $status;

    /**
     * @var string
     */
    protected $message;

    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param string $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }
}

<?php
namespace BuKoli;

use BuKoli\Exception\ValidateServiceParameterException;
use BuKoli\Result\OrderInsert;

/**
 * @author      Zeki Unal <zekiunal@gmail.com>
 * @description
 *
 * @package     BuKoli
 * @name        OrderInfo
 * @version     0.1
 * @created     2015/10/28 15:02
 */
class OrderInfo extends Client
{
    /**
     * @var string
     */
    protected $order_id;

    /**
     * @var string
     */
    protected $parent_order_id;

    /**
     * @var User
     */
    protected $user;

    /**
     * @var OrderDetail
     */
    protected $order_detail;

    /**
     * @var string
     */
    protected $point_code;

    /**
     * @var string
     */
    protected $invoice_number;

    /**
     * @var string
     */
    protected $waybill;

    /**
     * @var array
     */
    protected $service_parameters;

    /**
     * @return array
     */
    public function getServiceParameters()
    {
        return $this->service_parameters;
    }

    /**
     * @return string
     */
    public function getOrderId()
    {
        return $this->order_id;
    }

    /**
     * @param string $order_id
     */
    public function setOrderId($order_id)
    {
        $this->order_id = $order_id;
        $this->service_parameters['RequestOrderId'] = $order_id;
    }

    /**
     * @return string
     */
    public function getParentOrderId()
    {
        return $this->parent_order_id;
    }

    /**
     * @param string $parent_order_id
     */
    public function setParentOrderId($parent_order_id)
    {
        $this->parent_order_id = $parent_order_id;
        $this->service_parameters['ParentRequestOrderId'] = $parent_order_id;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return OrderDetail
     */
    public function getOrderDetail()
    {
        return $this->order_detail;
    }

    /**
     * @param OrderDetail $order_detail
     */
    public function setOrderDetail($order_detail)
    {
        $this->order_detail = $order_detail;
    }

    /**
     * @return string
     */
    public function getPointCode()
    {
        return $this->point_code;
    }

    /**
     * @param string $point_code
     */
    public function setPointCode($point_code)
    {
        $this->point_code = $point_code;
        $this->service_parameters['SelectedJetonPointCode'] = $point_code;
    }

    /**
     * @return string
     */
    public function getInvoiceNumber()
    {
        return $this->invoice_number;
    }

    /**
     * @param string $invoice_number
     */
    public function setInvoiceNumber($invoice_number)
    {
        $this->invoice_number = $invoice_number;
        $this->service_parameters['InvoiceNo'] = $invoice_number;
    }

    /**
     * @return string
     */
    public function getWaybill()
    {
        return $this->waybill;
    }

    /**
     * @param string $waybill
     */
    public function setWaybill($waybill)
    {
        $this->waybill = $waybill;
        $this->service_parameters['IrsaliyeNo'] = $waybill;
    }

    /**
     * @throws ValidateServiceParameterException
     */
    protected function validate()
    {
        if (
            empty($this->user) or
            empty($this->order_detail) or
            empty($this->client_password) or
            empty($this->point_code)
        ) {
            throw new ValidateServiceParameterException('Request order id, user, order detail, point code, password or
            waybill number cannot be null');
        }
    }

    public function toServiceParameters()
    {
        self::validate();
        return array(
            'integrationOrderInfo' => array(
                'RequestOrderId'                => $this->order_id,
                'ParentRequestOrderId'          => $this->parent_order_id,
                'EndUserData'                   => $this->user->getServiceParameters(),
                'IntegrationOrderDetailInfoArr' => $this->order_detail->getServiceParameters(),
                'SelectedJetonPointCode'        => $this->point_code,
                'CustomerServicePassword'       => $this->getClientPassword(),
                'InvoiceNo'                     => $this->invoice_number,
                'IrsaliyeNo'                    => $this->waybill
            ));
    }

    public function send()
    {
        return (new OrderInsert($this->client->OrderInsert($this->toServiceParameters())));
    }
}

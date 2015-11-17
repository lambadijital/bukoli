<?php
namespace BuKoli;
use BuKoli\Exception\ValidateServiceParameterException;

/**
 * @author      Zeki Unal <zekiunal@gmail.com>
 * @description
 *
 * @package     BuKoli
 * @name        OrderDetail
 * @version     0.1
 * @created     2015/10/28 14:53
 */
class OrderDetail extends Client
{
    /**
     * @var int
     */
    protected $de;

    /**
     * @var string
     */
    protected $info;

    /**
     * @var string
     */
    protected $barcode;

    /**
     * @var array
     */
    protected $service_parameters;

    /**
     * @throws ValidateServiceParameterException
     */
    protected function validate()
    {
        if (empty($this->de) or empty($this->info)) {
            throw new ValidateServiceParameterException('Deci or info cannot be null');
        }
    }

    /**
     * @return array
     */
    public function getServiceParameters()
    {
        self::validate();
        return array(
            'IntegrationOrderDetailInfo' => $this->service_parameters
        );
    }

    /**
     * @return int
     */
    public function getDe()
    {
        return $this->de;
    }

    /**
     * @param int $de
     */
    public function setDe($de)
    {
        $this->de = $de;
        $this->service_parameters['Deci'] = $de;
    }

    /**
     * @return string
     */
    public function getInfo()
    {
        return $this->info;
    }

    /**
     * @param string $info
     */
    public function setInfo($info)
    {
        $this->info = $info;
        $this->service_parameters['Info'] = $info;
    }

    /**
     * @return string
     */
    public function getBarcode()
    {
        return $this->barcode;
    }

    /**
     * @param string $barcode
     */
    public function setBarcode($barcode)
    {
        $this->barcode = $barcode;
        $this->service_parameters['Barcode'] = $barcode;
    }

    public function toServiceParameters()
    {
        return array(
            'Deci'    => $this->de,
            'Info'    => $this->info,
            'Barcode' => $this->barcode
        );
    }
}

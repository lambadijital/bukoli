<?php
namespace BuKoli;

/**
 * @author      Zeki Unal <zekiunal@gmail.com>
 * @description
 *
 * @package     BuKoli
 * @name        Client
 * @version     0.1
 * @created     2015/10/28 14:39
 */
class Client
{
    /**
     * @var \SoapClient
     */
    protected $client;

    /**
     * @var string
     */
    protected $client_password;

    /**
     * @var string
     */
    protected $web_service_url = "https://bukoli.borusan.com/IntegrationServiceTest/JetonOrderService.asmx?WSDL";

    /**
     * @param string $password
     * @param string $web_service_url
     */
    public function __construct($password = null, $web_service_url = null)
    {
        if ($web_service_url) {
            $this->web_service_url = $web_service_url;
        }

        if ($password) {
            $this->client_password = $web_service_url;
        }

        $this->client = new \SoapClient($this->web_service_url);
    }

    /**
     * @return string
     */
    public function getClientPassword()
    {
        return $this->client_password;
    }

    /**
     * @param string $client_password
     */
    public function setClientPassword($client_password)
    {
        $this->client_password = $client_password;
    }

    /**
     * @return string
     */
    public function getWebServiceUrl()
    {
        return $this->web_service_url;
    }

    /**
     * @param string $web_service_url
     */
    public function setWebServiceUrl($web_service_url)
    {
        $this->web_service_url = $web_service_url;
        $this->client = new \SoapClient($this->web_service_url);
    }
}

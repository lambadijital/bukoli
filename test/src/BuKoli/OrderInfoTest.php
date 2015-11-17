<?php
namespace BuKoli;

/**
 * @author      Zeki Unal <zekiunal@gmail.com>
 * @description
 *
 * @package     BuKoli
 * @name        OrderInfoTest
 * @version     0.1
 * @created     2015/10/31 22:35
 */
class OrderInfoTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var OrderInfo
     */
    protected $order_info;

    public function setUp()
    {
        $order_detail = new OrderDetail();
        $order_detail->setBarcode(171804847258);
        $order_detail->setDe(111);
        $order_detail->setInfo(1111);

        $user = new User();
        $user->setBirthday('1981-06-13');
        $user->setEmail('email@email.com');
        $user->setFirstName('FirstName');
        $user->setLastName('LastName');
        $user->setGender(-1);
        $user->setIndentityNumber('asv');
        $user->setJob('Job');
        $user->setMartialStatus(-1);
        $user->setPhone('5335514040');

        $this->order_info = new OrderInfo();
        $this->order_info->setClientPassword("ANRGGCLBU2V55LKKSY3E");
        $this->order_info->setInvoiceNumber("150909-47786");
        $this->order_info->setOrderDetail($order_detail);
        $this->order_info->setPointCode("TDR-4327");
        $this->order_info->setUser($user);
    }

    public function testSend()
    {
        $order_insert_result = $this->order_info->send();
        $this->assertInstanceOf('BuKoli\Result\OrderInsert', $order_insert_result);
        $this->assertEquals(1, $order_insert_result->getStatus());
        $this->assertNotEmpty($order_insert_result->getTrackingNumber());
    }
}

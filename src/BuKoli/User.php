<?php
namespace BuKoli;

use BuKoli\Exception\InvalidArgumentException;
use BuKoli\Exception\InvalidEnumArgumentException;
use BuKoli\Exception\ValidateServiceParameterException;

/**
 * @author      Zeki Unal <zekiunal@gmail.com>
 * @description
 *
 * @package     BuKoli
 * @name        User
 * @version     0.1
 * @created     2015/10/28 14:52
 */
class User
{
    /**
     * @var string
     */
    protected $user_id;

    /**
     * @var string
     */
    protected $first_name;

    /**
     * @var string
     */
    protected $last_name;

    /**
     * @var string
     */
    protected $phone;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var string
     */
    protected $indentity_number;

    /**
     * @var string
     */
    protected $address;

    /**
     * @var string
     */
    protected $birthday;

    /**
     * @var string
     */
    protected $job;

    /**
     * @description -1, 0, 1
     * @var int
     */
    protected $martial_status;

    /**
     * @description -1, 0, 1
     * @var int
     */
    protected $gender;

    /**
     * @var array
     */
    protected $service_parameters;

    protected function isItValidDate($date)
    {
        if (preg_match("/^(\d{4})-(\d{2})-(\d{2})$/", $date, $matches)) {
            if (checkdate($matches[2], $matches[3], $matches[1])) {
                return true;
            }
        }
    }

    /**
     * @return string
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @param string $user_id
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
        $this->service_parameters['EndUserCode'] = $user_id;
    }

    /**
     * @throws ValidateServiceParameterException
     */
    protected function validate()
    {
        if (empty($this->first_name) or empty($this->last_name) or empty($this->email)) {
            throw new ValidateServiceParameterException('first name, last name or email cannot be null');
        }
    }

    /**
     * @return array
     */
    public function getServiceParameters()
    {
        self::validate();
        return $this->service_parameters;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * @param string $first_name
     */
    public function setFirstName($first_name)
    {
        $this->first_name = $first_name;
        $this->service_parameters['FirstName'] = $first_name;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * @param string $last_name
     */
    public function setLastName($last_name)
    {
        $this->last_name = $last_name;
        $this->service_parameters['LastName'] = $last_name;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
        $this->service_parameters['Phone'] = $phone;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
        $this->service_parameters['Email'] = $email;
    }

    /**
     * @return string
     */
    public function getIndentityNumber()
    {
        return $this->indentity_number;
    }

    /**
     * @param string $indentity_number
     */
    public function setIndentityNumber($indentity_number)
    {
        $this->indentity_number = $indentity_number;
        $this->service_parameters['TcIdentityNo'] = $indentity_number;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
        $this->service_parameters['Address'] = $address;
    }

    /**
     * @return string
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * @param string $birthday
     *
     * @throws InvalidArgumentException
     */
    public function setBirthday($birthday)
    {
        if (!$this->isItValidDate($birthday)) {
            throw new InvalidArgumentException('Entered date is invalid. Valid format is YYYY-mm-dd');
        }
        $this->birthday = $birthday;
        $this->service_parameters['BirthDate'] = $birthday;
    }

    /**
     * @return string
     */
    public function getJob()
    {
        return $this->job;
    }

    /**
     * @param string $job
     */
    public function setJob($job)
    {
        $this->job = $job;
        $this->service_parameters['Job'] = $job;
    }

    /**
     * @return int
     */
    public function getMartialStatus()
    {
        return $this->martial_status;
    }

    /**
     * @description     (-1 ) UnKnown
     *                  ( 0 ) Single
     *                  ( 1 ) Married
     *
     * @param int $martial_status
     *
     * @throws InvalidEnumArgumentException
     */
    public function setMartialStatus($martial_status)
    {
        if (array_search($martial_status, array(-1, 0, 1)) === false) {
            throw new InvalidEnumArgumentException('Not expected argument.');
        }

        $this->martial_status = $martial_status;
        $this->service_parameters['MartialStatus'] = $martial_status;
    }

    /**
     * @return int
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @description     (-1 ) UnKnown
     *                  ( 0 ) Female
     *                  ( 1 ) Male
     *
     * @param int $gender
     *
     * @throws InvalidEnumArgumentException
     */
    public function setGender($gender)
    {
        if (array_search($gender, array(-1, 0, 1)) === false) {
            throw new InvalidEnumArgumentException('Not expected argument.');
        }
        $this->gender = $gender;
        $this->service_parameters['Sex'] = $gender;
    }

    public function toServiceParameters()
    {
        return array(
            'EndUserCode'   => $this->user_id,
            'FirstName'     => $this->first_name,
            'LastName'      => $this->last_name,
            'Phone'         => $this->phone,
            'Email'         => $this->email,
            'TcIdentityNo'  => $this->indentity_number,
            'Address'       => $this->address,
            'BirthDate'     => $this->birthday,
            'Job'           => $this->job,
            'MartialStatus' => $this->martial_status,
            'Sex'           => $this->gender
        );
    }
}

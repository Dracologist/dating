<?php
/**
 * Created by PhpStorm.
 * User: ejcka
 * Date: 2/16/2018
 * Time: 7:09 PM
 */

class Member
{
    protected $fname;
    protected $lname;
    protected $age;
    protected $gender;
    protected $phone;
    protected $email;
    protected $state;
    protected $seeking;
    protected $bio;

    function __construct($first, $last, $years, $sex, $number, $address, $home, $wants, $biography)
    {
        $this->fname = $first;
        $this->lname = $last;
        $this->age = $years;
        $this->gender = $sex;
        $this->phone = $number;
        $this->email= $number;
        $this->state = $home;
        $this->seeking = $wants;
        $this->bio = $biography;
    }

    /**
     * @return mixed
     */
    public function getFname()
    {
        return $this->fname;
    }

    /**
     * @return mixed
     */
    public function getLname()
    {
        return $this->lname;
    }

    /**
     * @return mixed
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * @return mixed
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @return mixed
     */
    public function getSeeking()
    {
        return $this->seeking;
    }

    /**
     * @return mixed
     */
    public function getBio()
    {
        return $this->bio;
    }

}
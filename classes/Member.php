<?php
/**
 * An object representing a member.
 * User: Elizabeth Kanzler
 * Date: 2/16/2018
 * Time: 7:09 PM
 */

class Member
{
    /**
     * @var the first name of the member
     */
    protected $fname;
    /**
     * @var the last name of the member
     */
    protected $lname;
    /**
     * @var the age of the member
     */
    protected $age;
    /**
     * @var the gender of the member
     */
    protected $gender;
    /**
     * @var the phone number of the member
     */
    protected $phone;
    /**
     * @var the email address of the member
     */
    protected $email;
    /**
     * @var the state of the member
     */
    protected $state;
    /**
     * @var the gender the member is seeking
     */
    protected $seeking;
    /**
     * @var the bio of the member
     */
    protected $bio;

    /**
     * Member constructor.
     * @param $first the first name of the member
     * @param $last the last name of the member
     * @param $years the age of the member
     * @param $sex the gender of the member
     * @param $number the phone number of the member
     * @param $address the email address of the member
     * @param $home the state of the member
     * @param $wants the gender the member is seeking
     * @param $biography the bio of the member
     */
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
     * @return string
     */
    public function getFirstname()
    {
        return $this->fname;
    }

    /**
     * @return string
     */
    public function getLastname()
    {
        return $this->lname;
    }

    /**
     * @return int
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @return int
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @return string
     */
    public function getSeeking()
    {
        return $this->seeking;
    }

    /**
     * @return string
     */
    public function getBio()
    {
        return $this->bio;
    }

}
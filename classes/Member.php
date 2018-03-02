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
     * @return the
     */
    public function getLname()
    {
        return $this->lname;
    }

    /**
     * Member constructor.
     * @param $first the first name of the member
     * @param $last the last name of the member
     * @param $years the age of the member (must be a number 18 or over)
     * @param $sex the gender of the member
     * @param $number the phone number of the member
     */
    function __construct($first, $last, $years, $sex, $number)
    {
        $this->fname = $first;
        $this->lname = $last;
        if($years >= 18 && is_numeric($years)) {
            $this->age = $years;
        }
        $this->gender = $sex;
        $this->phone = $number;
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
     * @return the
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
     * @return the
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

    /**
     * @param string $lname
     */
    public function setLname($lname)
    {
        $this->lname = $lname;
    }

    /**
     * Sets the age of the member.
     * Age must be a number greater than or equal to 18.
     * @param int the age of the member
     */
    public function setAge($age)
    {
        if($age >= 18 && is_numeric($age)) {
            $this->age = $age;
        }
    }

    /**
     * @param string the gender of the member.
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    /**
     * @param the $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * Sets the email address of the member.
     * Email adress must match the format 'someone@example.com'.
     * @param the $email
     */
    public function setEmail($email)
    {
        if(preg_match("/^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/", $email)) {
            $this->email = $email;
        }
    }

    /**
     * @param the $state
     */
    public function setState($state)
    {
        $this->state = $state;
    }

    /**
     * @param the $seeking
     */
    public function setSeeking($seeking)
    {
        $this->seeking = $seeking;
    }

    /**
     * Sets the Bio of the member.
     * Bio must be at least one character long.
     * @param the $bio
     */
    public function setBio($bio)
    {
        if(strlen($bio) >= 1) {
            $this->bio = $bio;
        }
    }

    /**
     * @return string the member's first name
     */
    public function getFname()
    {
        return $this->fname;
    }

    /**
     * @param string the member's first name
     */
    public function setFname($fname)
    {
        $this->fname = $fname;
    }

}
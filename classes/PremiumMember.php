<?php
/**
 * Created by PhpStorm.
 * User: ejcka
 * Date: 2/16/2018
 * Time: 7:09 PM
 */

class PremiumMember extends Member
{
    private $_indoorInterests;
    private $_outdoorInterests;

    function __construct($first, $last, $years, $sex, $number, $address, $home, $wants, $biography, $in, $out)
    {
        parent::__construct($first, $last, $years, $sex, $number, $address, $home, $wants, $biography);
        $this->_indoorInterests = $in;
        $this->_outdoorInterests = $out;
    }

    /**
     * @return mixed
     */
    public function getIndoorInterests()
    {
        return $this->_indoorInterests;
    }

    /**
     * @param mixed $outdoorInterests
     */
    public function setOutdoorInterests($outdoorInterests)
    {
        $this->_outdoorInterests = $outdoorInterests;
    }


}
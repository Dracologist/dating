<?php
/**
 * An object representing a premium member.
 * User: User: Elizabeth Kanzler
 * Date: 2/16/2018
 * Time: 7:09 PM
 */

class PremiumMember extends Member
{
    /**
     * @var the indoor interests of the member
     */
    private $_indoorInterests;
    /**
     * @var the outdoor interests of the member
     */
    private $_outdoorInterests;

    /**
     * PremiumMember constructor.
     * @param $first the first name of the member
     * @param $last the last name of the member
     * @param $years the age of the member
     * @param $sex the gender of the member
     * @param $number the phone number of the member
     * @param $address the email address of the member
     * @param $home the state of the member
     * @param $wants the gender the member is seeking
     * @param $biography the bio of the member
     * @param $in the indoor interests of the member
     * @param $out the outdoor interests of the member
     */
    function __construct($first, $last, $years, $sex, $number, $address, $home, $wants, $biography, $in, $out)
    {
        parent::__construct($first, $last, $years, $sex, $number, $address, $home, $wants, $biography);
        $this->_indoorInterests = $in;
        $this->_outdoorInterests = $out;
    }

    /**
     * @return array
     */
    public function getIndoorInterests()
    {
        return $this->_indoorInterests;
    }

    /**
     * @param array
     */
    public function setOutdoorInterests($outdoorInterests)
    {
        $this->_outdoorInterests = $outdoorInterests;
    }


}
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
     * @return array
     */
    public function getOutdoorInterests()
    {
        return $this->_outdoorInterests;
    }

    /**
     * @param array $indoorInterests
     */
    public function setIndoorInterests($indoorInterests)
    {
        $this->_indoorInterests = $indoorInterests;
    }

    /**
     * @return array $indoorInterests
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
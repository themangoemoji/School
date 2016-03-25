<?php
/**
 * Created by PhpStorm.
 * User: mhw
 * Date: 3/25/16
 * Time: 2:56 AM
 */

namespace Felis;


class ClientCase
{

    /*Begin Member Variables
    -----------------------*/

    const STATUS_OPEN = "O";	///< Case is open
    const STATUS_CLOSED = "C";	///< Case is closed

    private $id;
    private $client;
    private $clientName;
    private $agent;
    private $agentName;
    private $number;
    private $summary;
    private $status;



    /*--------------------
    End Member Variables*/




    /**
     * ClientCase constructor.
     * @param $agent
     * @param $agentName
     * @param $client
     * @param $clientName
     * @param $id
     * @param $number
     * @param $status
     * @param $summary
     */
    public function __construct($row)
    {
        $this->agent = $row['agent'];
        $this->agentName = $row['agentName'];
        $this->client = $row['client'];
        $this->clientName = $row['clientName'];
        $this->id = $row['id'];
        $this->number = $row['number'];
        $this->status = $row['status'];
        $this->summary = $row['summary'];
    }



    /**
     * @return mixed
     */
    public function getAgent()
    {
        return $this->agent;
    }

    /**
     * @return mixed
     */
    public function getAgentName()
    {
        return $this->agentName;
    }

    /**
     * @return mixed
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @return mixed
     */
    public function getClientName()
    {
        return $this->clientName;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return mixed
     */
    public function getSummary()
    {
        return $this->summary;
    }




}
<?php
/**
 * Created by PhpStorm.
 * User: mhw
 * Date: 3/25/16
 * Time: 2:56 AM
 */

namespace Felis;


class Cases extends Table
{

    /*Begin Member Variables
    ----------------------*/

    protected $site;

    /*-------------------
    End Member Variables*/


    /**
     * Constructor
     * @param $site The Site object
     */
    public function __construct(Site $site)
    {
        parent::__construct($site, "clientcase");
        $this->site = $site;
    }

    /**
     * Get a case by id
     * @param $id The case by ID
     * @returns Case object if successful, null otherwise.
     */
    public function exists($num)
    {
        $users = new Users($this->site);
        $usersTable = $users->getTableName();
        $sql = <<<SQL
SELECT c.id, c.client, client.name as clientName,
       c.agent, agent.name as agentName,
       number, summary, status
from $this->tableName c,
     $usersTable client,
     $usersTable agent
where c.client = client.id and
      c.agent=agent.id and
      c.number=?
SQL;

        /*
        PDO object is our connection to the database.
        We get that here from our base class
*/
        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        /*
               Result will fetch user data into an associative array and pass that to the User constructor, or it will
               return zero rows
        */
        $statement->execute(array($num));
        if($statement->rowCount() === 0) {
            return false;
        }

        return true;

    }


    /**
     * Get a case by id
     * @param $id The case by ID
     * @returns Case object if successful, null otherwise.
     */
    public function delete($id)
    {
        $users = new Users($this->site);
        $usersTable = $users->getTableName();
        $sql = <<<SQL
DELETE
from $this->tableName
where id=?
SQL;

        /*
        PDO object is our connection to the database.
        We get that here from our base class
*/
        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        /*
               Result will fetch user data into an associative array and pass that to the User constructor, or it will
               return zero rows
        */
        $statement->execute(array($id));
        if($statement->rowCount() === 0) {
            return null;
        }

        $clientcase = new ClientCase($statement->fetch(\PDO::FETCH_ASSOC));
        return $clientcase;

    }





    /**
     * Get a case by id
     * @param $id The case by ID
     * @returns Case object if successful, null otherwise.
     */
    public function get($id)
    {
        $users = new Users($this->site);
        $usersTable = $users->getTableName();
        $sql = <<<SQL
SELECT c.id, c.client, client.name as clientName,
       c.agent, agent.name as agentName,
       number, summary, status
from $this->tableName c,
     $usersTable client,
     $usersTable agent
where c.client = client.id and
      c.agent=agent.id and
      c.id=?
SQL;

        /*
        PDO object is our connection to the database.
        We get that here from our base class
*/
        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        /*
               Result will fetch user data into an associative array and pass that to the User constructor, or it will
               return zero rows
        */
        $statement->execute(array($id));
        if($statement->rowCount() === 0) {
            return null;
        }

        $clientcase = new ClientCase($statement->fetch(\PDO::FETCH_ASSOC));
        return $clientcase;

    }

    /**
     * @param $client The client whose case we open
     * @param $agent The agent on the case
     * @param $number Case number
     * @return null
     */
    public function insert($client, $agent, $number) {
        $sql = <<<SQL
insert into $this->tableName(client, agent, number, summary, status)
values(?, ?, ?, "", "")
SQL;

        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        try {
            if($statement->execute(array($client, $agent, $number)) === false) {
                return null;
            }
        } catch(\PDOException $e) {
            return null;
        }

        return $pdo->lastInsertId();
    }

    /**
     * Returns all cases
     * Sort by status, case number
     */
    public function getCases()
    {
        $users = new Users($this->site);
        $usersTable = $users->getTableName();
        $sql = <<<SQL

        SELECT c.id, c.client, client.name as clientName,
c.agent, agent.name as agentName,
number, summary, status
FROM $this->tableName as c
Inner Join $usersTable as client on client.id=c.client
Inner Join $usersTable as agent on agent.id=c.agent
order by status desc, number asc

SQL;

        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        /*
               Result will fetch user data into an associative array and pass that to the User constructor, or it will
               return zero rows
        */
        $statement->execute(array());
        if ($statement->rowCount() === 0) {
            return null;
        }

        $clientcases = $statement->fetchAll(\PDO::FETCH_ASSOC);

        $retArr = array();

        foreach($clientcases as $case) {

            $retArr[] = new ClientCase($case);

        }

        return $retArr;

    }


    /**
     * Update a case record
     * @param ClientCase $case Modified case
     * @return false on failure
     */
    public function update(ClientCase $case, $id) {
        $sql = <<<SQL
update $this->tableName
set number=?, agent=?, summary=?, status=?
where id=$id
SQL;

        $stmt = $this->pdo()->prepare($sql);
        $ret = $stmt->execute(array($case->getNumber(), $case->getAgent(), $case->getSummary(), $case->getStatus()));

        return $ret;
    }



}
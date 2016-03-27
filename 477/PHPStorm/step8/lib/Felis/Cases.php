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


}
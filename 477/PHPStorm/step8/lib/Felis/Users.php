<?php
namespace Felis;

/**
 * Manage users in our system.
 */
class Users extends Table {


    /**
     * Modify a user record based on the contents of a User object
     * @param User $user User object for object with modified data
     * @return true if successful, false if failed or user does not exist
     */
    public function update(User $user) {

        $sql =<<<SQL
UPDATE $this->tableName
SET email=?, name=?, phone=?, address=?, notes=?, role=?
WHERE id=?
SQL;

        if ($this->get($user->getId()) == null) {
            return false;
        }

        $email = $user->getEmail();
        $name = $user->getName();
        $phone = $user->getPhone();
        $address = $user->getAddress();
        $notes = $user->getNotes();
        $role = $user->getRole();
        $id = $user->getId();

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
        try {
            $ret = $statement->execute(array($email, $name, $phone, $address, $notes, $role, $id));
        } catch(\PDOException $e) {
            // do something when the exception occurs...
            return false;
        }
        return $ret;

    }


    /**
     * Constructor
     * @param $site The Site object
     */
    public function __construct(Site $site) {
        parent::__construct($site, "user");
    }


    /**
     * Get a user based on the id
     * @param $id ID of the user
     * @returns User object if successful, null otherwise.
     */
    public function get($id) {
        $sql =<<<SQL
SELECT * from $this->tableName
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

        return new User($statement->fetch(\PDO::FETCH_ASSOC));


    }


    /**
     * Test for a valid login.
     * @param $email User email
     * @param $password Password credential
     * @returns User object if successful, null otherwise.
     */
    public function login($email, $password) {

        $sql =<<<SQL
SELECT * from $this->tableName
where email=? and password=?
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
        $statement->execute(array($email, $password));
        if($statement->rowCount() === 0) {
            return null;
        }

        return new User($statement->fetch(\PDO::FETCH_ASSOC));

    }

    /**
     * Return all client names from users table
     */
    public function getClients()
    {

        $sql = <<<SQL
SELECT u.name, u.id
from $this->tableName u
where u.role = 'C'
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
        $statement->execute(array());
        if($statement->rowCount() === 0) {
            return null;
        }

        $clients = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return $clients;


    }


}
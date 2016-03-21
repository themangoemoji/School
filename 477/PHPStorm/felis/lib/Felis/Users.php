<?php
namespace Felis;

/**
 * Manage users in our system.
 */
class Users extends Table {


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

}
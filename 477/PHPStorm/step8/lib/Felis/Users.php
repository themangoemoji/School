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
     * Get a user based on the id
     * @param $id ID of the user
     * @returns User object if successful, null otherwise.
     */
    public function getAll() {
        $sql =<<<SQL
SELECT * from $this->tableName
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
        }

        $users = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return $users;

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
where email=?
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
        $statement->execute(array($email));
        if($statement->rowCount() === 0) {
            return null;
        }

        $row = $statement->fetch(\PDO::FETCH_ASSOC);

        // Get the encrypted password and salt from the record
        $hash = $row['password'];
        $salt = $row['salt'];

        // Ensure it is correct
        if($hash !== hash("sha256", $password . $salt)) {
            return null;
        }

        return new User($row);

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
        }

        $clients = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return $clients;


    }

    /**
     * Return all agent names from users table
     */
    public function getAgents()
    {

        $sql = <<<SQL
SELECT distinct u.name
from $this->tableName u
where u.role = 'a' OR u.role = 's'
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
        }

        $clients = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return $clients;


    }


    /**
     * Determine if a user exists in the system.
     * @param $email An email address.
     * @returns true if $email is an existing email address
     */
    public function exists($email) {

        $sql = <<<SQL
SELECT distinct u.email
from $this->tableName u
where u.email=?
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
        $statement->execute(array($email));
        if($statement->rowCount() === 0) {
            return false;
        }

        return true;


    }


    /**
     * Create a new user.
     * @param User $user The new user data
     * @param Email $mailer An Email object to use
     * @return null on success or error message if failure
     */
    public function add(User $user, Email $mailer) {
        // Ensure we have no duplicate email address
        if($this->exists($user->getEmail())) {
            return "Email address already exists.";
        }

        // Add a record to the user table
        $sql = <<<SQL
INSERT INTO $this->tableName(email, name, phone, address, notes, joined, role)
values(?, ?, ?, ?, ?, ?, ?)
SQL;

        $statement = $this->pdo()->prepare($sql);
        $statement->execute(array(
            $user->getEmail(), $user->getName(), $user->getPhone(), $user->getAddress(),
            $user->getNotes(), date("Y-m-d H:i:s"), $user->getRole()));
        $id = $this->pdo()->lastInsertId();

        // Create a validator and add to the validator table
        $validators = new Validators($this->site);
        $validator = $validators->newValidator($id);

        // Send email with the validator in it
        $link = "http://webdev.cse.msu.edu"  . $this->site->getRoot() .
            '/password-validate.php?v=' . $validator;

        $from = $this->site->getEmail();
        $name = $user->getName();

        $subject = "Confirm your email";
        $message = <<<MSG
<html>
<p>Greetings, $name,</p>

<p>Welcome to Felis. In order to complete your registration,
please verify your email address by visiting the following link:</p>

<p><a href="$link">$link</a></p>
</html>
MSG;
        $headers = "MIME-Version: 1.0\r\nContent-type: text/html; charset=iso=8859-1\r\nFrom: $from\r\n";
        $mailer->mail($user->getEmail(), $subject, $message, $headers);
    }

    /**
     * Set the password for a user
     * @param $userid The ID for the user
     * @param $password New password to set
     */
    public function setPassword($userid, $password) {

        $salt = self::randomSalt();
        $salted_password = (hash("sha256", $password . $salt));

        $sql = <<<SQL
UPDATE $this->tableName
SET password=?, salt=?
WHERE id=?
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


        echo $this->sub_sql($sql, array($salted_password, $salt, $userid));


        try {
            $ret = $statement->execute(array($salted_password, $salt, $userid));
        } catch(\PDOException $e) {
            // do something when the exception occurs...
            return null;
        }

        return $ret;


    }

    /**
     * Generate a random salt string of characters for password salting
     * @param $len Length to generate, default is 16
     * @returns Salt string
     */
    public static function randomSalt($len = 16) {
        $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789`~!@#$%^&*()-=_+';
        $l = strlen($chars) - 1;
        $str = '';
        for ($i = 0; $i < $len; ++$i) {
            $str .= $chars[rand(0, $l)];
        }
        return $str;
    }

}
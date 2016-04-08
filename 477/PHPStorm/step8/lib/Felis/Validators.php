<?php
/**
 * Created by PhpStorm.
 * User: mhw
 * Date: 3/29/16
 * Time: 2:06 PM
 */

namespace Felis;


class Validators extends Table
{

    /**
     * Validator constructor.
     */
    public function __construct(Site $site)
    {
        $this->site = $site;
        parent::__construct($site, "validator");

    }

    /**
     * Create a new validator and add it to the table.
     * @param $userid User this validator is for.
     * @return The new validator.
     */
    public function newValidator($userid) {
        $validator = $this->createValidator();

        // Write to the table
        $sql = <<<SQL
INSERT INTO $this->tableName(userid, validator, date)
values(?, ?, ?)
SQL;

        $statement = $this->pdo()->prepare($sql);
        $statement->execute(array($userid, $validator, date("Y-m-d H:i:s")));

        return $validator;
    }


    /**
     * @brief Generate a random validator string of characters
     * @param $len Length to generate, default is 32
     * @returns Validator string
     */
    private function createValidator($len = 32) {
        $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $l = strlen($chars) - 1;
        $str = '';
        for ($i = 0; $i < $len; ++$i) {
            $str .= $chars[rand(0, $l)];
        }
        return $str;
    }


    /**
     * Determine if a validator is valid. If it is,
     * get the user ID for that validator. Then destroy any
     * validator records for that user ID. Return the
     * user ID.
     * @param $validator Validator to look up
     * @return User ID or null if not found.
     */
    public function getOnce($validator) {

        // See if validator exists first
        // Query for userid, validator from validator table, match on the validator
        $sql = <<<SQL
SELECT distinct v.userid, v.validator
from $this->tableName v
where v.validator=?
SQL;
            $pdo = $this->pdo();
            $statement = $pdo->prepare($sql);

            /*
                   Result will fetch user data into an associative array and pass that to the User constructor, or it will
                   return zero rows
            */
            $statement->execute(array($validator));

            // DEBUG Line
            $rowcount = $statement->rowCount();

            if($statement->rowCount() === 0) {
                return null;
            }

            // Delete the validator if it was found
            else {
                $userid_row = $statement->fetch(\PDO::FETCH_ASSOC);
                $userid = $userid_row['userid'];
                $validator = $userid_row['validator'];




                $sql = <<<SQL
DELETE from $this->tableName
where userid=?
SQL;
                $pdo = $this->pdo();
                $statement = $pdo->prepare($sql);

                /*
                       Result will fetch user data into an associative array and pass that to the User constructor, or it will
                       return zero rows
                */
                $statement->execute(array($userid));

                return $userid;

            }


            return null;



        }


    /**
     * Determine if a validator is valid. If it is,
     * get the user ID for that validator. Then destroy any
     * validator records for that user ID. Return the
     * user ID.
     * @param $validator Validator to look up
     * @return User ID or null if not found.
     */
    public function getMoreThanOnce($validator) {

        // See if validator exists first
        // Query for userid, validator from validator table, match on the validator
        $sql = <<<SQL
SELECT distinct v.userid, v.validator
from $this->tableName v
where v.validator=?
SQL;
        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        /*
               Result will fetch user data into an associative array and pass that to the User constructor, or it will
               return zero rows
        */
        $statement->execute(array($validator));

        // DEBUG Line
        $rowcount = $statement->rowCount();

        if($statement->rowCount() === 0) {
            return null;
        }

        // Delete the validator if it was found
        else {
            $userid_row = $statement->fetch(\PDO::FETCH_ASSOC);
            $userid = $userid_row['userid'];
            $validator = $userid_row['validator'];


            return $userid;

        }


        return null;



    }

    private $name;
    private $validator;
    private $date;
    protected $site;
}
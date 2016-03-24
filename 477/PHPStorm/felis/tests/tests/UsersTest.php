<?php
require __DIR__ . "/../../vendor/autoload.php";
/** @file
 * @brief Empty unit testing template/database version
 * @cond 
 * @brief Unit tests for the class 
 */

class UsersDBTest extends \PHPUnit_Extensions_Database_TestCase
{
    private static $site;

    public static function setUpBeforeClass() {
        self::$site = new Felis\Site();
        $localize  = require 'localize.inc.php';
        if(is_callable($localize)) {
            $localize(self::$site);
        }
    }


	/**
     * @return PHPUnit_Extensions_Database_DB_IDatabaseConnection
     */
    public function getConnection()
    {
        return $this->createDefaultDBConnection(self::$site->pdo(), 'wrigh517');
    }


    /**
     * @return PHPUnit_Extensions_Database_DataSet_IDataSet
     */
    public function getDataSet()
    {
        return $this->createFlatXMLDataSet(dirname(__FILE__) . '/db/user.xml');
    }


    public function test_construct() {
        $users = new Felis\Users(self::$site);
        $this->assertInstanceOf('Felis\Users', $users);
    }

    public function test_login() {
        $users = new Felis\Users(self::$site);

        // Test a valid login based on user ID
        $user = $users->login("dudess@dude.com", "87654321");
        $this->assertInstanceOf('Felis\User', $user);

        // Test a valid login based on email address
        $user = $users->login("cbowen@cse.msu.edu", "super477");
        $this->assertInstanceOf('Felis\User', $user);

        // Test a failed login
        $user = $users->login("dudess@dude.com", "wrongpw");
        $this->assertNull($user);

        /*
         * Test for first login attempt
         * <test_user id="7" email="dudess@dude.com" name="Dudess, The"
         * phone="111-222-3333" address="Dudess Address"
         * notes="Dudess Notes" password="87654321"
         * joined="2015-01-22 23:50:26" role="S" />
        */
        $dude = $users->login("dudess@dude.com", "87654321");
        $this->assertEquals($dude->getEmail(), "dudess@dude.com");
        $this->assertEquals($dude->getAddress(), "Dudess Address");
        $this->assertEquals($dude->getId(), "7");
        $this->assertEquals($dude->getJoined(), "1421988626");
        $this->assertEquals($dude->getName(), "Dudess, The");
        $this->assertEquals($dude->getNotes(), "Dudess Notes");
        $this->assertEquals($dude->getPhone(), "111-222-3333");
        $this->assertEquals($dude->getRole(), "S");


    }


    public function test_get() {
        $users = new Felis\Users(self::$site);

        $dude = $users->get(7);
        $this->assertInstanceOf('Felis\User', $dude);

    }


    public function test_update() {
        $users = new Felis\Users(self::$site);

        $owen = $users->get(8);
        $owen->setEmail("ourlordandsaviour@cse.msu.edu");
        $owen->setAddress("Nazareth");
        $owen->setName("Jesus Christ Himself");
        $owen->setNotes("On the third day I will rise and feed the world nachos");
        $owen->setPhone("696-969-6969");
        $owen->setRole("S");

        $users->update($owen);

        $owen_post_rapture = $users->get(8);

        $this->assertNotEquals($owen_post_rapture->getEmail(), "dudess@dude.com");
        $this->assertNotEquals($owen_post_rapture->getAddress(), "Dudess Address");
        $this->assertNotEquals($owen_post_rapture->getId(), "7");
        $this->assertNotEquals($owen_post_rapture->getJoined(), "1421988626");
        $this->assertNotEquals($owen_post_rapture->getName(), "Dudess, The");
        $this->assertNotEquals($owen_post_rapture->getNotes(), "Dudess Notes");
        $this->assertNotEquals($owen_post_rapture->getPhone(), "111-222-3333");
        $this->assertNotEquals($owen_post_rapture->getRole(), "A");

        $this->assertEquals($owen_post_rapture->getEmail(), "ourlordandsaviour@cse.msu.edu");
        $this->assertEquals($owen_post_rapture->getAddress(), "Nazareth");
        $this->assertEquals($owen_post_rapture->getId(), "8");
        $this->assertEquals($owen_post_rapture->getName(), "Jesus Christ Himself");
        $this->assertEquals($owen_post_rapture->getNotes(), "On the third day I will rise and feed the world nachos");
        $this->assertEquals($owen_post_rapture->getPhone(), "696-969-6969");
        $this->assertEquals($owen_post_rapture->getRole(), "S");

    }
}

/// @endcond
?>

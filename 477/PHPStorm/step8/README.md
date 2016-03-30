# Step 8 - Website and SQL Database Interaction

## Contents

[Passwords, Salt, and Validation](inserting-passwords)

[Error Messages](error-messages)

### Inserting passwords

To securely insert a user into a database, you have to remember these things:

1. Salt the password
2. Encrypt the password

###### Salting a Password in PHP

What is salt? It is added length do an encrypted password so that brute-force attacks take much longer.
Yes, if the `hackers` got access to the DB, then it doesnt matter, but thats another matter.

For example we might end up setting the password for a user like so:

```php
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

        try {
            $ret = $statement->execute(array($salted_password, $salt, $userid));
        } catch(\PDOException $e) {
            // do something when the exception occurs...
            return null;
        }
        // return true
        return $ret;
    }
```
    
  
Basically what we do here is to generate random salt, take a clear text password, concatanate those two and use the sha hash to create a very long confusing string - and we store that very long confusing string into our database.

Then our login function will also have to use salt, right? Yep. It grabs the salt from the user table, grabs the password it is passed, combines the two, and makes sure it super matches the long confusing password string in our database.

###### Logging in

```php
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
```

### Error Messages

Error messages are controlled mainly by the, well, controller. Because of this, we make a controller base class that manages errors:

```php
<?php

namespace Felis;

/**
 * Base class for any controllers I use
 *
 * I created this so I would not be repeating work such
 * as the redirect functionality and saving a session
 * reference.
 */
class Controller {
    /**
     * Controller constructor.
     * @param Site $site The Site object
     * @param $session Session array by reference
     */
    public function __construct(Site $site, &$session) {
        $this->site = $site;

        // We must assign by reference if we want to be
        // able to change the session.
        $this->session = &$session;

        // Ensure no error is set in the session
        unset($this->session[View::SESSION_ERROR]);
    }

    /**
     * Get the redirect location link.
     * @return page to redirect to.
     */
    public function getRedirect() {
        return $this->redirect;
    }

    /**
     * General mechanism for error handling
     * @param $page Page we go to
     * @param $msg Message to display on the page
     */
    protected function error($page, $msg) {
        $root = $this->site->getRoot();
        if(strstr($page, '?') !== false ) {
            $this->redirect = "$root/$page&e";
        } else {
            $this->redirect = "$root/$page?e";
        }

        $this->session[View::SESSION_ERROR] = $msg;
    }


    protected $redirect;	///< Page we will redirect the user to.

    protected $site;		///< The Site object
    protected $session;		///< $_SESSION
}
```


Then all other controllers inherit from this:

```php
<?php
/**
 * Created by PhpStorm.
 * User: mhw
 * Date: 3/28/16
 * Time: 10:42 PM
 */

namespace Felis;


class PasswordValidateController extends Controller
{



    /**
     * HomeController constructor.
     * @param Site $site Site object
     * @param array $post $_POST
     * @param array $session $_SESSION
     */
    public function __construct(Site $site, $post, &$session)
    {
        parent::__construct($site, $session);

        $root = $site->getRoot();
...
```


In order to do this we need to make sure our post pages know about the `$_SESSION`:


```php
<?php
require '../lib/site.inc.php';

$controller = new Felis\PasswordValidateController($site, $_POST, $_SESSION);
header("location: " . $controller->getRedirect());

```

And lastly, our `View` needs to know of the `$_SESSION`, and it **emplaces our errors** as well:

```php
<?php
namespace Felis;

/**
 * Base class for all views
 */
class View {
	/**
	 * Optional name to save an error message under in the session.
	 */
	const SESSION_ERROR = "felis_error";

	/**
	 * View constructor.
	 * @param array $get $_GET
	 * @param array $session $_SESSION
	 */
	public function __construct(Site $site, array $get, array $session) {
		/*
		 * When I found that several pages needed $_GET and $_SESSION
		 * and error message handling, I found it easiest to just move
		 * that into the View base class.
		 */
		$this->site = $site;
		$this->get = $get;
		$this->session = $session;
	}

...

/**
	 * Get any optional error messages
	 * @return string Optional error message HTML or empty if none.
	 */
    public function errorMsg() {
        if(isset($this->get['e']) && isset($this->session[self::SESSION_ERROR])) {
            return '<p class="error">' . $this->session[self::SESSION_ERROR] . '</p>';
        } else {
            return '';
        }
    }

```


![schema]()

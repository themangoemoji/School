# Contents



**[General Step Notes](#step-notes)**  
**[Database Notes](#database-notes)**  
**[Grades](#grades)**  


## Step Notes

#### Install/Set Up Composer

```
php -r "readfile('https://getcomposer.org/installer');" | php
php composer.phar install
```

#### Debugging in PHPStorm

1. Connect to Debugging Tunnel Via SSH

`ssh -L 9001:webdev.cse.msu.edu:9001 -R 9151:localhost:9151 wrigh517@webdev.cse.msu.edu`

*Note:* This must stay open while debugging.

2. Configuring PHPStorm

    * *Preferenes > Expand Languages and Frameworksdebugging*

    * Enter 9151 as the Xdebug Debug Port

    * Set max. simultaneous connections to 2

    * Go back to *Debug > DBGp Proxy*, set:
      
      * IDE Key to: wrigh517 
      * Host to: localhost 
      * Port to: 9001

  * Exit Preferences, choose *Tools>DBGp Proxy>Register IDE*. It should say Xdebug proxy: IDE successfully registered with ide key 'wrigh517'.

3. Enabling Debugging

    * *Run > Break on first line in PHP scripts*
    
    * *Run>Start Listening for PHP Debug Connections*

    * You need some empty PHP file in your project (Ex: empty.php).  To enable debugging click on this link:

        http://webdev.cse.msu.edu/~wrigh517/step7/empty.php?XDEBUG_SESSION_START=wrigh517

    * When you are done debugging, click on this link to turn the debug mode off:

        http://webdev.cse.msu.edu/~wrigh517/step7/empty.php?XDEBUG_SESSION_STOP



## Database Notes

#### Create a PDO Object

To use a database in PHP, you first need to create a PDO object:

```php
try {
  $this->pdo = new \PDO($this->dbHost, 
      $this->dbUser, 
      $this->dbPassword);
} catch(\PDOException $e) {
  // If we can't connect we die!
  die("Unable to select database");
}
```

#### Prepare SQL Statement

```php
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
```

#### Execute SQL Statemento

```php
/*
  Result will fetch user data into an associative array and pass that to the 
  User constructor, or it will return zero rows
 */
$statement->execute(array($email, $password));
```

#### Obtaining Results

```php
if($statement->rowCount() == 0) {
  return null;
}

// Get one result
return new User($statement->fetch(\PDO::FETCH_ASSOC));
```



## Grades
[Look away and be happier](https://facweb.cse.msu.edu/cbowen/cse477/lib/grading/grades.php)

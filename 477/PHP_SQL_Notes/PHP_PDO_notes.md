# PHP/PDO/SQL Notes

Example working with PDO in PHP class `World`

1. Connect to the sample database

```php
  public function __construct() {
    try {
      $this->pdo = new PDO(
          'mysql:host=mysql-user.cse.msu.edu;dbname=cse477s', 
          'cse477sro',
          'Letmesql');
    } catch(PDOException $e) {
      // If we can't connect we die!
      die("Unable to select database");
    }
  }
```

2. We will need a member variable for that:

```php
  private $pdo;   // PDO object
```

3. And the table to present the info in:

```php
  public function present() {
    $html = <<<HTML
      <table>
      <tr><th>Country</th><th>Population</th></tr>
      <tr><td>Jamaica</td><td>2583000</td></tr>
      </table>
      HTML;

    return $html;
  }
```


All together:

```php

<?php
class World{

  private $pdo;   // PDO object

  public function __construct() {
    try {
      $this->pdo = new PDO(
          'mysql:host=mysql-user.cse.msu.edu;dbname=cse477s', 
          'cse477sro',
          'Letmesql');
    } catch(PDOException $e) {
      // If we can't connect we die!
      die("Unable to select database");
    }
  }


  public function present() {
    $html = <<<HTML
      <table>
      <tr><th>Country</th><th>Population</th></tr>
      <tr><td>Jamaica</td><td>2583000</td></tr>
      </table>
      HTML;

    return $html;
  }

}

```

Next we want to create a simple query:

```sql
select name, population
from Country
where region="Caribbean"
```

Do to that, we'll add this to the beginning of `present()`:

```php
$sql = <<<SQL
select name, population
from Country
where region=?
SQL;

$stmt = $this->pdo->prepare($sql);
```

And then we can execute with:

```php
if(!$stmt->execute(array("Caribbean"))) {
  return "<p>SQL execution failed.</p>";
}
```



```php
```

# Connecting to MySQL in PHP using PDO
Connecting to MySQL with PDO. it easy for you and secure for your company project

### Installation

require or include in your project page, where you need to connect your database.r.

```sh
define('ACCESS_ALLOW',true);
require('app/config/connect_me.php');
```
You can change define the text "ACCESS_ALLOW" as you what.
if you what to change the text. Search file path: "app/config/connect_me.php"
in this file, you can change "defined('ACCESS_ALLOW')"
```sh
private static function Block_Access()
{ return (!defined('ACCESS_ALLOW')) ? true : false;  }
```
When you have changed it. !defined('ACCESS_ALLOW') to !defined('Something')
you'll use with changes:
```sh
define('something',true);
require('app/config/connect_me.php');
```
it just include and requires security. direct access still blocked

### How to use it

Create a class Object:
```sh
$pdo = new connect_me();
```

Database resource:
```sh
$this->conn   //Database handler queries
$q = $pdo->conn->prepare("SELECT * FROM `user`");    /** Example of query */
```
Basic Example

```sh
define('ACCESS_ALLOW',true);
require('app/config/connect_me.php');
    
$pdo = new connect_me();
$q = $pdo->conn->prepare("SELECT * FROM `user`");
$q->execute();
while($row = $q->fetch(PDO::FETCH_OBJ))
{
echo $row->user_name."<br>";
}
```


License MIT

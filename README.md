# PDO MySQL Connection Example

Secure PDO connection using environment variables and a small reusable class.

## Requirements
- PHP 7.4+ with PDO extension enabled
- MySQL / MariaDB server
- Minimal database user privileges for the application

## Setup
1. Place database credentials in environment variables:
   - `DB_HOST`
   - `DB_NAME`
   - `DB_USER`
   - `DB_PASS`

2. Do not store credentials directly in `app/config/connect_me.php`.

## Usage
In `index.php` or any page that needs a database connection:

```php
define('ACCESS_ALLOW', true);
require 'app/config/connect_me.php';

$db = new ConnectMe();
$pdo = $db->getConnection();
```

Then run queries safely with prepared statements:

```php
$statement = $pdo->prepare('SELECT user_name FROM `user` WHERE id = :id');
$statement->execute([':id' => $userId]);
$user = $statement->fetch();
```

## Example

```php
<?php
define('ACCESS_ALLOW', true);
require 'app/config/connect_me.php';

$db = new ConnectMe();
$pdo = $db->getConnection();

$statement = $pdo->prepare('SELECT user_name FROM `user`');
$statement->execute();

while ($row = $statement->fetch()) {
    echo htmlspecialchars($row['user_name'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') . '<br>';
}
```

## Security notes
- The class uses `PDO::ATTR_EMULATE_PREPARES = false` to protect against SQL injection.
- The connection file rejects direct access unless `ACCESS_ALLOW` is defined.
- Errors are logged instead of printed, and the application receives a generic failure message.
- Use a database account with only the permissions required by your app.

## License
MIT

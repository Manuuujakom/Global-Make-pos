<?php
// config.php

// Database credentials
// This file should be placed outside of your web root directory for production.
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root'); // Use a dedicated user with minimal permissions in production.
define('DB_PASSWORD', 'your_mysql_password_here'); // Your MySQL root password or the password for the user above.
define('DB_NAME', 'global_database');

// NOTE: In a production environment, you should use a dedicated database user
// with restricted permissions instead of 'root' for enhanced security.
?>

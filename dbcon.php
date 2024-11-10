<?php

if (!class_exists('dbcon')) {
    define("HOSTNAME", "localhost");
    define("USERNAME", "root");
    define("PASSWORD", "");
    define("DATABASE", "php_dev_shanika");

    // Use OOP standards.
    class dbcon {
        public $connection;

        // Establish database connection
        public function db_connect() {
            $this->connection = new mysqli(HOSTNAME, USERNAME, PASSWORD, DATABASE);

            if ($this->connection->connect_error) {
                die("Connection failed: " . $this->connection->connect_error);
            }
        }

        // Return the connection
        public function getConnection() {
            return $this->connection;
        }
    }
}

?>

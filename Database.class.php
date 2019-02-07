<?php

class Database {
    private $hostname;
    private $username;
    private $password;
    private $database;
    private $conn;

   
    function __construct($hostname, $username, $password, $database) {

        $this->hostname = $hostname;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;
        $this->conn = new mysqli($this->hostname, $this->username, $this->password, $this->database);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }

    }

    public function retriveData($sql) {
        $results = $this->conn->query($sql);

        $numRows = $results->num_rows;
        $data = array();
        if ($numRows > 0) {
            while ($row= $results->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;
        } else {
            return 'none';
        }
    }

    public function retriveValue($sql) {
        $result = $this->conn->query($sql);
        $numRows = $result->num_rows;
        if ($numRows > 0) {
            $row = $result->fetch_assoc();
            return reset($row);
        } else {
            return 'none';
        }
    }


    public function retriveRow($sql) {
        $result = $this->conn->query($sql);
        $numRows = $result->num_rows;
        if ($numRows > 0) {
            $row = $result->fetch_assoc();
            return $row;
        } else {
            return 'none';
        }
    }

    public function execute($sql) {
        $result = $this->conn->query($sql);
    }

}


?>

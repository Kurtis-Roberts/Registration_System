<?php
class DBController
{
    public $host = "localhost";
    public $user = "root";
    public $password = "root";
    public $database = "group2";
    public $conn;

    function __construct()
    {
        $this->conn = $this->connectDB();
    }
    function connectDB()
    {
        $conn = mysqli_connect($this->host, $this->user, $this->password, $this->database);
        return $conn;
    }
    function runQuery($query)
    {
        $result = mysqli_query($this->conn, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $resultset[] = $row;
        }
        if (!empty($resultset))
            return $resultset;
    }
}

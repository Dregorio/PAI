<?php

class ConnectionSQL implements IConnectInfo
{
    private $host = IConnectInfo::HOST;
    private $db_name = IConnectInfo::DB_NAME;
    private $db_user = IConnectInfo::DB_USER;
    private $db_password = IConnectInfo::DB_PASSWORD;

    function testConnection()
    {
        $conn = @new mysqli($this->host, $this->db_user, $this->db_password, $this->db_name);

        if (mysqli_connect_error()){
            echo "Error: ".$conn->connect_errno." Opis: ".$conn->connect_error;
            die("Error");
        }

        echo "Everything is ok";

        $conn->close();
    }

    static function connection()
    {
        $conn = new mysqli(self::HOST, self::DB_USER, self::DB_PASSWORD, self::DB_NAME);

        if ($conn->connect_errno != 0){
            echo "Error: ".$conn->connect_errno." Opis: ".$conn->connect_error;
            return null;
        }
        else{
            return $conn;
        }
    }
}
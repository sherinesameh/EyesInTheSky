<?php


class DbConnection {

    private $conn;
 
    
    
    function connect() {
        include_once dirname(__FILE__) . '/config.php';
 
        // Connecting to mysql database
        $this->conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
        // Check for database connection error
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        return $this->conn;
    }
 
 }

// $conn->query("CREATE DATABASE IF NOT EXISTS $serverDBname");
// $conn->query("USE $serverDBname");

// $conn->query("CREATE TABLE IF NOT EXISTS Generation(
//     Gen_id          INT(10)     NOT NULL,
//     specification   VARCHAR(50),

//     PRIMARY KEY(Gen_id)
//     )");

// $conn->query("CREATE TABLE IF NOT EXISTS Raspberry(
//     Rpi_id              INT(10)         AUTO_INCREMENT,
//     Ip                  INT(50)         NOT NULL,
//     Gen_id              INT(10)         NOT NULL,
//     Free_storage        VARCHAR(30)     NOT NULL,
//     Jobs                VARCHAR(30),
//     Has_camera          BOOLEAN,
//     Max_no_containers   INT(30),
//     Location_name       VARCHAR(200)    NOT NULL,
//     Map                 VARCHAR(300),

//     PRIMARY KEY(Rpi_id),
//     FOREIGN KEY(Gen_id) REFERENCES Generation(Gen_id)
//     )");

// $conn->query("CREATE TABLE IF NOT EXISTS Users(
//     User_id                 INT(10)     AUTO_INCREMENT,
//     Name                    VARCHAR(30) NOT NULL,
//     Username                VARCHAR(30) NOT NULL UNIQUE,
//     Email                   VARCHAR(30) NOT NULL UNIQUE,
//     Password                VARCHAR(50) NOT NULL,
//     Authority               VARCHAR(30) NOT NULL,
//     Birth_date              DATE        NOT NULL,
//     Image                   VARCHAR(100)NOT NULL,
//     Max_running_containers  INT(30),

//     PRIMARY KEY(User_id)
//     )");

// $conn->query("CREATE TABLE IF NOT EXISTS Jobs(
//     Cont_id         INT(10)     AUTO_INCREMENT,
//     Rpi_id          INT(10)     NOT NULL,
//     User_id         INT(10)     NOT NULL,
//     Process         INT(30)     NOT NULL,

//     PRIMARY KEY(Cont_id,Rpi_id),
//     FOREIGN KEY(Rpi_id)  REFERENCES Raspberry(Rpi_id),
//     FOREIGN KEY(User_id) REFERENCES Users(User_id)
//     )");
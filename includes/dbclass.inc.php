<?php
include_once('dbh.inc.php');

class Database {
    public function sanitize($var) {
        $return = mysqli_real_escape_string($conn, $var);
        return $return;
    }

    public function insert($firstname, $lastname, $email, $phone, $companyid) {
        $sql = "INSERT INTO customer (firstname, lastname, email, phone, companyid) VALUES ('$firstname', '$lastname', '$email', '$phone', '$companyid');";
        $res = mysqli_query($conn, $sql);
    }
}

$database = new Database()

/* 
    Assume you need to make a class for orders in the database schema
    you created. write a simple class that handles each CRUD functionality
    on the order and in the case of the read, pull all relevant data from
    each table in the schema. Optimally I would like to see a PHP class,
    however any language that you are most comfortable with will work.
    The primary objective here is for me to see how you solve the problem,
    secondary is PHP ability.
*/
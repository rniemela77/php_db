<?php 
    include_once 'dbh.inc.php';

    // Prevent sql
    $first = mysqli_real_escape_string($conn, $_POST['first']);
    $last = mysqli_real_escape_string($conn, $_POST['last']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $company = mysqli_real_escape_string($conn, $_POST['company']);


    // $sql = "INSERT INTO `customer` (`id`, `firstname`, `lastname`, `phone`, `email`, `companyid`) VALUES (NULL, 'korb', 'kobano', '11111', 'kkb@gmail.com', '1');"
    $sql = "INSERT INTO customer (id, firstname, lastname, phone, email, companyid) VALUES (NULL, '$first', '$last', '$phone', '$email', '$company');";
    mysqli_query($conn, $sql);

    // Since we are using POST, make it relocate to the index
    header("Location: ../index.php?addcustomer=success");
?>
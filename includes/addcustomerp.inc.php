<?php 
    include_once 'dbh.inc.php';

    // Prevent sql injection
    $first = mysqli_real_escape_string($conn, $_POST['first']);
    $last = mysqli_real_escape_string($conn, $_POST['last']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $company = mysqli_real_escape_string($conn, $_POST['company']);


    // $sql = "INSERT INTO `customer` (`id`, `firstname`, `lastname`, `phone`, `email`, `companyid`) VALUES (NULL, 'korb', 'kobano', '11111', 'kkb@gmail.com', '1');"
    $sql = "INSERT INTO customer (id, firstname, lastname, phone, email, companyid) VALUES (NULL, ?, ?, ?, ?, ?);";

    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "SQL error";
    } else {
        mysqli_stmt_bind_param($stmt, "sssss", $first, $last, $phone, $email, $company);
        mysqli_stmt_execute($stmt);
    }

    // Since we are using POST, make it relocate to the index
    header("Location: ../index.php?addcustomer=success");
?>
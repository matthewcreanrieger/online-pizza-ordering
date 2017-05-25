<?php

function isUsernameTaken($username) {
    global $pdo;
    //this query gets a count of users who already have the provided username
    $query = "SELECT COUNT(*) FROM customers WHERE username = :username";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":username", $username);
    $stmt->execute();
    $count = $stmt->fetchColumn();

    //return TRUE if there was a query error; this makes it seem like the user exists when it might now
    if($count === FALSE) {
        return TRUE;
    }

    if ($count > 0)
        return TRUE;
    else
        return FALSE;
}
function createUser($username, $password, $firstname, $lastname, $phone, $email, $address) {
    global $pdo;
    //Salt and hash the provided password
    $hasher = new PasswordHash(8, FALSE);
    $hash = $hasher->HashPassword($password);

    //this query inserts the new user record into the table with the salted and hashed password
    $query = "INSERT INTO customers (username, password, first_name, last_name, phone, email, address) VALUES (:username, :password, :first_name, :last_name, :phone, :email, :address)";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":username", $username);
    $stmt->bindParam(":password", $hash);
    $stmt->bindParam(":first_name", $firstname);
    $stmt->bindParam(":last_name", $lastname);
    $stmt->bindParam(":phone", $phone);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":address", $address);

    return $stmt->execute();
}

function checkAuth($username, $password) {
    global $pdo;
    //This query gets the password hash from the user table for the user attempting to login
    $query = "SELECT password FROM customers WHERE username = :username";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":username", $username);
    $stmt->execute();
    $result = $stmt->fetchColumn();

    if ($result === FALSE)
        return FALSE;

    //Hash the provided password and compare to the hash from the database
    $hasher = new PasswordHash(8, FALSE);

    return $hasher->CheckPassword($password, $result);
}

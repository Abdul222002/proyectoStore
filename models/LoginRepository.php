<?php

class LoginRepository {

    public static function login($username, $password) {
        $db= Connection::connect();
        $q= "SELECT * FROM users WHERE name='" . $username . "' AND password='" . $password . "'"   ;
        $result= $db->query($q);
        if($result->num_rows==1){
            $row= $result->fetch_assoc();
            // Orden correcto: user_id, name, email, password, role
            $user= new User($row['user_id'], $row['name'], $row['email'], $row['password'], $row['role']);
            return $user;
        }
        return null;
    }

  public static function createUser($username, $password, $confirmPassword, $email) {
        
        if ($password !== $confirmPassword) {
            return false;
        }

        $db = Connection::connect();
        $q = "INSERT INTO users (name, email, password) VALUES ('" . $username . "', '" . $email . "', '" . md5($password) . "')";
        if ($db->query($q) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

     public static function getUserById($id) {
        $db = Connection::connect();
        $q = "SELECT * FROM users WHERE user_id='" . $id . "'";
        $result = $db->query($q);
        if ($row = mysqli_fetch_assoc($result)) {
            return new User($row['user_id'], $row['name'], $row['email'], $row['password'], $row['role']);
        }
        return null;
    }
}
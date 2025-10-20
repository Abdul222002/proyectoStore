<?php

class User {
  private $id;
  private $username;
  private $email;
  private $password;
  private $role;
  private $image;

  public function __construct($id, $username, $email, $password, $role, $image) {
    $this->id = $id;
    $this->username = $username;
    $this->email = $email;
    $this->password = $password;
    $this->role = $role;
    $this->image = $image;
  }

  public function getImage() {
    return $this->image;
  }

  public function getId() {
    return $this->id;
  }

  public function getUsername() {
    return $this->username;
  }

  public function getEmail() {
    return $this->email;
  }

  public function getPassword() {
    return $this->password;
  }

  public function getRole() {
    return $this->role;
  }

}

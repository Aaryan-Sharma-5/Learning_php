<?php

class User {
  public $name;
  public $email;
  public $password;

  public function __construct($name, $email, $password) {
    $this->name = $name;
    $this->email = $email;
    $this->password = $password;
  }

}

$user1 = new User('John', 'john@gmail.com', '123');
$user2 = new User('Jane', 'jane@gmail.com','456');


echo $user1->name;
echo '<br>';
echo $user2->name;
echo '<br>';

class Admin extends User {
  public function __construct($name, $email, $password) {
    parent::__construct($name, $email, $password);
  }

  public function get_title() {
    return  $this->name;
  }
}

$admin1 = new Admin('Adam', 'admin@gmail.com', '789');
echo $admin1->get_title();


?>
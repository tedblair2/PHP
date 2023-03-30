<?php

class User
{
    private $email;
    private $name;

    public function __construct($name, $email)
    {
        $this->name = $name;
        $this->email = $email;
    }
    public function printUser()
    {
        echo 'Name: ' . $this->name . ' == Email: ' . $this->email . '<br />';
    }
    public function getName()
    {
        return $this->name;
    }
    public function setName($value)
    {
        $this->name = $value;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function setEmail($value)
    {
        $this->email = $value;
    }
}

$userone = new User('Ted Omino', 'ominoblair@gmail.com');
$usertwo = new User('Israel Omino', 'Israelomino@gmail.com');
$userone->printUser();
$usertwo->printUser();

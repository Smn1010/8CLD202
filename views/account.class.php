
<?php

class Account
{
    public $id;
    public $name;
    public $firstName;
    public $mail;
    public $password;
    public $permission;

    function __construct($id, $name, $firstname, $mail, $permission)
    {
        $this->id = $id;
        $this->name = $name;
        $this->firstName = $firstname;
        $this->mail = $mail;
        $this->permission = $permission;
    }


    /***************** ID ******************/
    function setId($id)
    {
        $this->id = $id;
    }

    function getId()
    {
        return $this->id;
    }

    /***************** NAME ******************/
    function setName($name)
    {
        $this->name = $name;
    }

    function getName()
    {
        return $this->name;
    }

    /***************** FIRST NAME ******************/
    function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    function getFirstName()
    {
        return $this->firstName;
    }



    /***************** MAIL ******************/
    function setMail($mail)
    {
        $this->mail = $mail;
    }

    function getMail()
    {
        return $this->mail;
    }

    /***************** Password ******************/
    function setPassword($password)
    {
        $this->password = $password;
    }

    function getPassword()
    {
        return $this->password;
    }

    /***************** PERMISSION ******************/
    function setPermission($permission)
    {
        $this->permission = $permission;
    }

    function getPermisison()
    {
        return $this->permission;
    }
}

?>
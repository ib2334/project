<?php
class UserInfo{
    private $ID;
    private $pass;
    private $fname;
    private $lname;
    private $email;
    public function __construct($ID, $fn, $ln, $em, $pass)
    {
        $this->ID=$ID;
        $this->pass=$pass;
        $this->fname=$fn;
        $this->lname=$ln;
        $this->email=$em;
    }
    public function getID(){
        return $this->ID;
    }
    public function getfName(){
        return $this->fname;
    }
    public function getlName(){
        return $this->lname;
    }
    public function getpass(){
        return $this->pass;
    }
    public function getem(){
        return $this->email;
    }
    public function __destruct()
    {
    }
}
?>
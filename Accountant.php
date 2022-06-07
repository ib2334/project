<?php
    session_start();
    include "../Frontend/TopNav.html";
    require_once "User.php";
    require "UserInfo.php";
    require "Fees.php";
    require "ShowSal.php";
    class Accountant extends UserInfo implements User, ShowSal{
        use Fees;
        public function __construct($ID, $fn, $ln, $em, $pass)
        {
            parent::__construct($ID, $fn, $ln, $em, $pass);
        }
        public function ShowProfile(){
            echo $this->getID();
            echo "<hr>";
            echo $this->getfName();
            echo "<hr>";
            echo $this->getlName();
            echo "<hr>";
            echo $this->getem();
            echo "<hr>";
        }
        public function ShowSal(){
            echo $this->getAccountantSalary();
        }
        public function ShowSemFee(){
            echo $this->getSemesterFee();
        }
    }
?>
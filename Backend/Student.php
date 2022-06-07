<?php
    session_start();
    include "TopNav.html";
    require_once "User.php";
    require "UserInfo.php";
    require "Courses.php";
    require "CourseInterface.php";
    class Student extends UserInfo implements User, CourseInterface{
        private $phone;
        private $address;
        private $busid;
        use Courses{
            __construct as crs;
        }
        public function __construct($ID, $fn, $ln, $em, $pass, $ph, $ad, $bid)
        {
            parent::__construct($ID, $fn, $ln, $em, $pass);
            $this->phone=$ph;
            $this->address=$ad;
            $this->busid=$bid;
        }
        public function SetCourse($CID,$CN)
        {
            $this->crs($CID,$CN);
        }
        public function getadd(){
            return $this->address;
        }
        public function getph(){
            return $this->phone;
        }
        public function getbid(){
            return $this->busid;
        }
        public function __destruct()
        {
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
            echo $this->getph();
            echo "<hr>";
            echo $this->getadd();
            echo "<hr>";
            echo $this->getbid();
            echo "<hr>";
        }
        public function ShowCRS(){
            echo $this->getCID();
            echo "<hr>";
            echo $this->getCN();
            echo "<hr>";
        }
    }
    //Function reads courseid, and returns course name when found
    function readCID($CID){
        $filename='../Invoices/Courses.txt';
        $file=fopen($filename, 'a+') or die ('File Inaccesible');
        $seperator="|";
        while(!feof($file)){
            $line=fgets($file);
            $Arrline=explode($seperator,$line);
            if($Arrline[0]==$CID){
                return $Arrline[1];
                fclose($file);
            }
        }
        fclose($file);
    }
    //Recieve ID from login page, searches for it in student file, then creates an object of the student
    $id_value = $_SESSION['ID'];
    $filename='../Invoices/Student.txt';
    $file=fopen($filename, 'a+') or die ('File Inaccesible');
    $seperator="|";
    while(!feof($file)){
        $line=fgets($file);
        $Arrline=explode($seperator,$line);
        if($Arrline[0]==$id_value){
            $st=new Student($Arrline[0],$Arrline[1],$Arrline[2],$Arrline[3],$Arrline[4],$Arrline[5],$Arrline[6],$Arrline[7]);
        }
    }
    fclose($file);
    echo "Profile:<br><br>";
    $st->ShowProfile();
    echo "<br><br>";
    echo "Courses:<br><br>";
    /*Searches for student id in the student to course relation file,
        when found, inputs the corresponding course id in a variable then used to be sent as a parametre,
        2 functions are called, SetCourse which constructs courseid, and coursename,
        coursename is constructed by calling readCID function, which searches for course id inside of courses file,
        when found, the function returns the course name related to the course id,
        ShowCRS function is called to output the course id and course name from trait course
    */
    $filename='../Invoices/StToCrsRelation.txt';
    $file=fopen($filename, 'a+') or die ('File Inaccesible');
    $seperator="|";
    while(!feof($file)){
        $line=fgets($file);
        $Arrline=explode($seperator,$line);
        if($st->getID()==$Arrline[0]){
            $CID=$Arrline[1];
            $st->SetCourse($Arrline[1],readCID($CID[1]));
            $st->ShowCRS();
        }
    }
    fclose($file);
?>
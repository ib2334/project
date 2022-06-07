<?php
	session_start();
	include "TopNav.html";
	require_once "User.php";
	require "UserInfo.php";
	require "Courses.php";
    require "CourseInterface.php";
	class Teacher extends UserInfo implements User , CourseInterface
	{
	    private $phone;
	    private $address;
	    use Courses{
		__construct as crs; 
	}
	public function setcrs($id,$name)
	{
		$this->crs($id,$name);

	}
	public function ShowCRS()
	{
		echo $this->getCID();
		echo"<hr>";
		echo $this->getCN();
		echo "<hr>";
	}
	    public function __construct($add, $ph)
	    {
	        $this->phone=$ph;
	        $this->address=$add;
	    }
        
        public function getph()
        {
        return $this->phone;
        }
        public function getadd()
        {
        return $this->address;
        }
		function __destruct(){
		}
	    public function ShowProfile()
	    {
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
	    }
	}
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
	$id_value= $_SESSION['ID'];
	$filename= '../Invoices/Teacher.txt';
	$file=fopen($filename, 'a+') or die('File Inaccesible');
	$seperator="|";
	while(!feof($file))
	{
	    $line=fgets($file);
	    $Arrline=explode($seperator, $line);
	    if($Arrline[0]==$id_value)
	    {
	        $tch=new Teacher($Arrline[0],$Arrline[1],$Arrline[2],$Arrline[3],$Arrline[4],$Arrline[5],$Arrline[6]);
	    }
    }
    fclose($file);
	echo "profile:<br><br>";
	$tch->ShowProfile();
	echo"<br><br>";
	echo "course:<br><br>";
	$filename='../Invoices/TchToCrsRelation.txt';
    $file=fopen($filename, 'a+') or die ('File Inaccesible');
    $seperator="|";
    while(!feof($file)){
        $line=fgets($file);
        $Arrline=explode($seperator,$line);
        if($tch->getID()==$Arrline[0]){
            $CID=$Arrline[1];
            $tch->SetCRS($Arrline[1],readCID($CID[1]));
            $tch->ShowCRS();
        }
    }
	fclose($file);
?>

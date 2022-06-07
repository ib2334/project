<?php
    include "../Backend/Accountant.php";
    function InsertFee($CID,$Fee){
        $filename='../Invoices/CourseFees.txt';
        $str=$CID."|".$Fee."\r\n";
        $file=fopen($filename, 'a+') or die ('File Inaccesible');
        fwrite($file, $str);
        fclose($file);
    }
    function addSalary($sal,$id){
        $filename='../Invoices/Salaries.txt';
        $file=fopen($filename, 'a+') or die ('File Inaccesible');
        $str=$id."|".$sal."\r\n";
        fwrite($file, $str);
        fclose($file);
    }
    function semFees(){
        $filename='../Invoices/CourseFees.txt';
        $file=fopen($filename, 'a+') or die ('File Inaccesible');
        $seperator="|";
        $semfees=0;
        while(!feof($file)){
            $line=fgets($file);
            $Arrline=explode($seperator,$line);
            if(empty($Arrline[1])){
                break;
            }
            $x=intval($Arrline[1]);
            $semfees+=$x;
        }
        fclose($file);
        $semfees=trim($semfees);
        return $semfees;
    }
    function SetSal($ID){
        $filename='../Invoices/Salaries.txt';
        $file=fopen($filename, 'a+') or die ('File Inaccesible');
        $seperator="|";
        while(!feof($file)){
            $line=fgets($file);
            $Arrline=explode($seperator,$line);
            if($Arrline[0]==$ID){
                return $Arrline[1];
                fclose($file);
            }
        }
        fclose($file);
    }

    $id_value = $_SESSION['ID'];
    $filename='../Invoices/Accountant.txt';
    $file=fopen($filename, 'a+') or die ('File Inaccesible');
    $seperator="|";
    while(!feof($file)){
        $line=fgets($file);
        $Arrline=explode($seperator,$line);
        if($Arrline[0]==$id_value){
            $acc=new Accountant($Arrline[0],$Arrline[1],$Arrline[2],$Arrline[3],$Arrline[4]);
        }
    }
    fclose($file);
    $acc->ShowProfile();
    //Set Course Fees
    /*
    $testid="01";
    $testfee="5000";
    InsertFee($testid,$testfee);
    //Salary
    $tchid="111";
    $tchsal="7000";
    $accid="110";
    $accsal="10000";
    $adid="17";
    $adsal="6000";
    addSalary($tchsal,$tchid);
    addSalary($accsal,$accid);
    addSalary($adsal,$adid);*/
    //All fees
    $acc->setSemFee(semfees());
    $acc->ShowSemFee();
    //Salary
    echo"<br><br>";
	echo "Salary:<br><br>";
    $acc->setAccSal(SetSal($acc->getID()));
    $acc->ShowSal();
?>
<?php session_start(); include "TopNav.html"; ?>
<!DOCTYPE html>
<link rel="stylesheet" type="text/css" href="lgin.css">
<html>
    <head> 
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <script>
    //This function shows/hides passwords
    function myFunction() {
        var x = document.getElementById("inp");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
        }
    </script>
    <body>
        <?php
            //This calls a functions to validate inputs from user
            $red=true;
            $ID=$Email=$Pass="";
            $IDerr=$Emailerr=$Passerr="";
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (empty($_POST['ID'])) {
                    $IDerr = "ID is required";
                }else {
                    $ID=test_input($_POST['ID']);
                    if (!filter_var($ID, FILTER_VALIDATE_INT)) {
                       $IDerr = "Only numbers allowed";
                    }
                }
                if (empty($_POST['email'])) {
                   $Emailerr = "Email is required";
                
                } else {
                    $Email=test_input($_POST['email']);
                    if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
                        $Emailerr = "Invalid email format";
                    }
                }

                if (empty($_POST['pass'])) {
                    $Passerr = "Password is required";
                    
                } else {
                    $Pass=test_input($_POST['pass']);
                }
                if($IDerr=="" && $Emailerr=="" && $Passerr==""){
                    $red=true;
                }
                else{
                    $red=false;
                }
            }
            //Validation Function
            function test_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }
            //Searches for inputted id, email and password in the associated text files, then returns true if found
            function checkuser($file){
                $IDcheck=$_POST['ID'];
                $Emailcheck=$_POST['email'];
                $Passcheck=$_POST['pass'];
                $ct=0;
                $Err=2;
                $filetype=fopen($file,'a+') or die ('File Inaccesible');
                $seperator="|";
                while(!feof($filetype)){
                    $line=fgets($filetype);
                    $Arrline=explode($seperator,$line);
                    if($Arrline[0]==$IDcheck){
                        ++$ct;
                        fclose($filetype);
                        break;
                    }
                }
                $filetype=fopen($file,'a+') or die ('File Inaccesible');
                $seperator="|";
                while(!feof($filetype)){
                    $line=fgets($filetype);
                    $Arrline=explode($seperator,$line);
                    if($Arrline[3]==$Emailcheck){
                        ++$ct;
                       
                        fclose($filetype);
                        break;
                    }
                }
                $filetype=fopen($file,'a+') or die ('File Inaccesible');
                $seperator="|";
                while(!feof($filetype)){
                    $line=fgets($filetype);
                    $Arrline=explode($seperator,$line);
                    if($Arrline[4]==$Passcheck){
                        ++$ct;
                        fclose($filetype);
                        break;
                    }
                }
                if($ct==3){
                    return $IDcheck;
                }
                $Err=3;
                return $Err;
                fclose($filetype);
            }
        ?>
        <?php
            //Calls the search function with the text file depending on the user type
            $intype=filter_input(INPUT_POST, 'login', FILTER_UNSAFE_RAW);
            $utype=0;
            $uval="";
            if($intype=="Admin"){
                if(checkuser('../Invoices/Admin.txt') == 3 && $_POST['ID'] != ""){
                    $IDerr="Paramaters Invalid";
                }
                else{
                    $utype=checkuser('../Invoices/Admin.txt');
                    $uval="a";
                }
            }
            elseif($intype=="Student"){
                if(checkuser('../Invoices/Student.txt') == 3 && $_POST['ID'] != ""){
                    $IDerr="Paramaters Invalid";
                }
                else{
                    $utype=checkuser('../Invoices/Student.txt');
                    $uval="s";
                }
            }
            elseif($intype=="Teacher"){
                if(checkuser('../Invoices/Teacher.txt') == 3 && $_POST['ID'] != ""){
                    $IDerr="Paramaters Invalid";
                }
                else{
                    $utype=checkuser('../Invoices/Teacher.txt');
                    $uval="t";
                }
            }
            elseif($intype=="Accountant"){
                if(checkuser('../Invoices/Accountant.txt') == 3 && $_POST['ID'] != ""){
                    $IDerr="Paramaters Invalid";
                }
                else{
                    $utype=checkuser('../Invoices/Accountant.txt');
                    $uval="p";
                }
            }
        ?>
        <hr id="navsep"></hr>
        <div class="lgn">
            <h1 id="ln">Login</h1>
            <hr class="lnsep"></hr>
            <p class="info">Please Enter Your Information</p>
            <!--This chekcs the user type and redirects to their page after all validation is complete-->
            <form method="post" action="<?php if($red==true && $uval=="a"){
                header("Location: http://localhost/CS244/Backend/Admin.php");
                $_SESSION['ID'] = $utype;
            }
            elseif($red==true && $uval=="s"){
                header("Location: http://localhost/CS244/Backend/Student.php");
                $_SESSION['ID'] = $utype;
            }
            elseif($red==true && $uval=="t"){
                header("Location: http://localhost/CS244/Backend/Teacher.php");
                $_SESSION['ID'] = $utype;
            }
            elseif($red==true && $uval=="p"){
                header("Location: http://localhost/CS244/Backend/Accountant.php");
                $_SESSION['ID'] = $utype;
            }
            elseif ($red==false){
                echo htmlspecialchars($_SERVER["PHP_SELF"]);
            } ?>">
            <div class="form">
                ID: <input type="text" name="ID" value="<?php echo $ID;?>">
                <span class="error">* <?php echo $IDerr;?></span>
                <br><br>
                E-mail: <input type="text" name="email" value="<?php echo $Email;?>">
                <span class="error">* <?php echo $Emailerr;?></span>
                <br><br>
                Password: <input id="inp" type="password" name="pass" value="<?php echo $Pass;?>">
                <span class="error"><?php echo $Passerr;?></span>
                <br><br>
                <input type="checkbox" onclick="myFunction()">Show Password<br><br> <!--Calls JS function to show and hide password-->
                <label for="login">Type:</label>
                <select name="login" id="login">
                    <option value="Admin">Admin</option>
                    <option value="Student">Student</option>
                    <option value="Teacher">Teacher</option>
                    <option value="Accountant">Accountant</option>
                </select> <br><br>
                <input type="submit" name="submit" value="Login" class="lnbutton"><br><br>
                <a class="fp" href="http://localhost/CS244/Frontend/EmNewPass.php">Forgot Password?<br><br>
                </form>
            </div>
        </div>
    </body>
</html>
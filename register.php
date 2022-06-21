<!DOCTYPE HTML>
<HTML>
<HEAD>
    <TITLE>Register</TITLE>

    <link rel="stylesheet" href="styling.css">   
</head>

<body>
<button onclick='location.href="index.php"'>Back to Login</button>
<form action="" method="post">
    <fieldset text-align="center">
               <center>

                <legend><b>Register</b></legend> <br><br>
                <table>
                    <tr><th>Name:</th><td><input type="text" name='name' placeholder="Your Name"></td></tr>

                    <tr><th>Email:</th><td><input type="text" name='email' placeholder="Your Email"></td></tr>
                    
                    <tr><th>Password: </th><td><input type="password" name='pass' placeholder="******"></td></tr>
                    
                    <tr><th>Comapany Authentication: </th><td><input type="password" name="auth" placeholder="******"></td></tr>
                   
                    <tr><th>Register As: </th>
                    
                        <td>
                            <input type="radio" id="rep" name="registeration" value="representative">
                            <label>Data Entry Representative</label><br>
                            <input type="radio" id="emp" name="registeration" value="employee">
                            <label>Employee</label>
                        </td>
                    </tr>
                </table>
                <br><br>
            <input type="submit" value="Confirm" name="confirm">    
    </center>
    </fieldset>
</form>
<?php
    $link = mysqli_connect("localhost", "root", "");
    if (!$link) {
        die('Connect Error (' . mysqli_connect_errno() . ')' . my_sqli_connect_error());
    } else {
        mysqli_query($link,"CREATE DATABASE Company");
        mysqli_select_db($link,"Company");

        mysqli_query($link,"CREATE TABLE EMPLOYEE(email varchar(30),namev varchar(20),passwordv varchar(20),typev varchar(20))");


        if(isset($_POST['confirm'])){
            if(!$_POST['name'] || !$_POST['pass'] || !$_POST['auth'] || empty($_POST['registeration']|| !$_POST['email'])){
                echo "<center class='err'>Please complete your information </center>";
            }else{
        $name= $_POST['name'];
        $email = $_POST['email'];
        $pass= $_POST['pass'];
        $type = $_POST['registeration'];
        $code = "companycode";
        
        if($_POST['auth']==$code){
            $exists = mysqli_query($link, "SELECT * FROM EMPLOYEE WHERE email = '$email' ");
            if (mysqli_num_rows($exists)!=0) {
                 echo "<center class='err'>This email already exists, please choose another email</center>";
           }
           else{
                $indx = "index.php";
                $quotmark = '"';
                $insert = mysqli_query($link, "INSERT INTO EMPLOYEE values('$email','$name','$pass', '$type') ");
                if(!$insert){
                    echo "error";
                }
                echo "<center>Registered Successfully!</center>";
                echo mysqli_query($link, "SELECT FROM EMPLOYEE WHERE email = '$email' ");           }
        }
        else{
            echo "<center class='err'>Wrong Comapany Authentication</center>";

            
        }
        }
    }
    }

?>
<br>



</body>
</html>
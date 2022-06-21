<?php 
session_start();
if (isset($_SESSION['email'])){
    switch($_SESSION['type']){
        case "admin":
            header("Location: admin.php");
            break;
        case "representative":
            header("Location: representative.php");
            break;
        case "employee":
            header("Location: employee.php");
            break;
    }
}
?>

<!DOCTYPE HTML>
<HTML>
<HEAD>
    <TITLE>Company Inc.</TITLE>

    <link rel="stylesheet" href="styling.css">
</head>

<body>

<form action="checkLogin.php" method="post">
    <fieldset text-align="center"><center>
                <legend><b>Login</b></legend> <br><br>
                
                   Email:<input id = "email" name ="email" type="text" placeholder="Enter your Email">
                    <br />
                   Password: <input class = "password"id="passwordv" name="passwordv" type="password" placeholder="******">
                    <br />

                
            <input type="submit" value="Confirm">  </center> </fieldset>
</form>
<br><br>
<center><button onclick='location.href="register.php"'>Register</button> </center>

<?php



$link = mysqli_connect("localhost","root","");
if(!$link){
    die("Connection Error.");
}
//mysqli_query($link,"DROP DATABASE Company");
mysqli_query($link,"CREATE DATABASE Company");
mysqli_select_db($link,"Company");
mysqli_query($link,"CREATE TABLE EMPLOYEE(email varchar(30) PRIMARY KEY, namev varchar(20),passwordv varchar(20),typev varchar(20))");
mysqli_query($link, "CREATE TABLE Families(FamilyID int PRIMARY KEY,familyName varchar(25), addressv varchar(40),cityOrgov varchar(20), telephone_num varchar(20), numberOfMembers int)");
mysqli_query($link, "CREATE TABLE Individuals(namev varchar(20),sex varchar(6),dob varchar(30), nationalID int, marital_status varchar(10), mobile_num varchar(20) , academic_degree varchar(20), job varchar(20) , FamilyID int, FOREIGN KEY (FamilyID) REFERENCES Families(FamilyID))");


mysqli_query($link,"INSERT INTO Families values(0,'default','unknown','unknown',010,0)");
mysqli_query($link,"INSERT INTO EMPLOYEE VALUES('rep@census','OG Rep','r','representative')");
mysqli_query($link,"INSERT INTO EMPLOYEE VALUES('emp@census','OG Emp','e','employee')");

// //        mysqli_query($link,"INSERT INTO Families values (13,'afamily', 'somewhere','cairo',  123,2)");

// mysqli_query($link,"INSERT INTO Individuals values ('Ahmed', 'male', '1998/1/1' , 123, 'single', '111' , 'uni' ,'none' , 13  )");
// mysqli_query($link,"INSERT INTO Individuals values ('Hana', 'female', '1999/1/1' , 124, 'single', '111' , 'uni' , 'none' , 13 )");


?>

</body>
</html>



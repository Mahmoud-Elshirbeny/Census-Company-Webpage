<?php
    session_start();
    $email = $_POST['email'];
    $passwordv = $_POST['passwordv'];

    if($email == "admin" && $passwordv == "a"){
        session_start();
        $_SESSION["email"]="admin";
        $_SESSION["name"] = "admin";
        $_SESSION["password"] = "a";
        $_SESSION["type"]="admin";
        header("Location: admin.php");

    }

    $link = mysqli_connect("localhost","root","");
    if(!$link){
        die("Connection Error.");
    }


    
    mysqli_select_db($link,"Company");

    $checkExists = mysqli_query($link,"SELECT * FROM EMPLOYEE WHERE email = '$email' AND passwordv = '$passwordv';");
    if($checkExists){
        while($row = mysqli_fetch_array($checkExists))
        {
            echo"checking.";
            switch($row['typev']){
                case "employee":
                    $_SESSION["email"] = $email;
                    $_SESSION["name"] = $row['namev'];
                    $_SESSION["password"] = $passwordv;
                    $_SESSION["type"]="employee";
                    header("Location: employee.php");
                    break;
                case "representative":
                    $_SESSION["email"] = $email;
                    $_SESSION["name"] = $row['namev'];
                    $_SESSION["password"] = $passwordv;
                    $_SESSION["type"]="representative";
                    header("Location: representative.php");
                    break;
            }
            
        }
    }
    else {
        print "error in query check" . mysqli_error($checkExists);
    }


    mysqli_close($link);

?>
<head>
    <title>Login Check</title>
</head>

<script>
var a = alert('Wrong Name or Password. Ask admin for help.');
window.location.href = "index.php";
</script>

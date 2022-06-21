<?php
    session_start();

    if (!isset($_SESSION['email'])||!($_SESSION['type']=="admin")) {
        header("Location: index.php");
    }
    echo"<br><br>";
    echo "Hello, Admin: ".  $_SESSION['name'];
?>
<head>
    <title>Admin</title>
</head>
<br><br>
<button onclick='location.href="logout.php"'>Log Out</button>
<br><br>
<body>
    <form method="post">
        Email : <input type="text" name="email" placeholder="Email"><br><br>
        Name/Password: <input type="text" name="replacement" placeholder="New Name or Password"><br><br>
        <button name="changeName">Change Name</button>
        <button name="changePass">Change Password</button>
    </form>
    <?php
    $link = mysqli_connect("localhost", "root", "");
    if (!$link) {
        die('Connect Error (' . mysqli_connect_errno() . ')' . my_sqli_connect_error());
    } else {
        mysqli_query($link, "CREATE DATABASE Company");
        mysqli_select_db($link, "Company");


        if (isset($_POST["changeName"])) {
            if (!$_POST['email'] || !$_POST['replacement']) {
                echo "please complete the information";
            } else {
                $exist =  mysqli_query($link, "SELECT email FROM EMPLOYEE WHERE email = '$_POST[email]' ");
                if (mysqli_num_rows($exist) == 0) {
                    echo "This Email Doesn't Exist";
                } else {
                    $res = mysqli_query($link, "UPDATE EMPLOYEE SET namev= '$_POST[replacement]' where email='$_POST[email]'");
                    echo "Name Updated Successfully!";
                }
            }
        }

        if (isset($_POST["changePass"])) {
            if (!$_POST['email'] || !$_POST['replacement']) {
                echo "please complete the information";
            } else {
                $exist =  mysqli_query($link, "SELECT email FROM EMPLOYEE WHERE email = '$_POST[email]' ");
                if (mysqli_num_rows($exist) == 0) {
                    echo "This Email Doesn't Exist";
                } else {
                    mysqli_query($link, "UPDATE EMPLOYEE SET passwordv= '$_POST[replacement]' where email='$_POST[email]'");
                    echo "Password Updated Successfully!";
                }
            }
        }

        //Employee Table
        $info = mysqli_query($link, "SELECT * FROM EMPLOYEE ");

        echo "<table border=1>";
        echo "<tr><th>Email</th><th>Name</th><th>Password</th><th>Levels of Accessibility</th></tr>";
        while ($row = mysqli_fetch_array($info)) {
            echo "<tr>";
            for ($col = 0; $col < 4; $col++) {
                echo "<td>" . $row[$col] . "</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    }


    //Families Table
    $info = mysqli_query($link, "SELECT * FROM Families ");

    echo "<br><table border=1>";
    echo "<tr><th>Family ID</th> <th>Family Name</th><th>Address</th><th>City/ Governorate</th><th>Telephone Number</th><th>Number of individuals</th></tr>";
    // $counter = 0;

    // while ($row2 = mysqli_fetch_array($memNum)) {
    //     $tmp[$counter] = $row2[0];
    //     $counter++;
    // }
    // $counter = 0;

    while ($row = mysqli_fetch_array($info)) {
        echo "<tr>";
        for ($col = 0; $col < 6; $col++) {
            echo "<td>" . $row[$col] . "</td>";
        }
        echo"</tr>";
    }
    echo "</table>";
    //Individuals Table
    $info = mysqli_query($link, "SELECT * FROM Individuals ");

    echo "<br><table border=1>";
    echo "<tr><th>Name</th><th>Sex</th><th>Date Of Birth</th><th>National ID</th><th>Marital Status</th><th>mobile_num</th><th>Academic Degree</th><th>Job</th><th>Family ID</th> </tr>";
    while ($row = mysqli_fetch_array($info)) {
        echo "<tr>";
        for ($col = 0; $col < 9; $col++) {
            echo "<td>" . $row[$col] . "</td>";
        }
        echo "</tr>";
    }
    echo "</table>";


    ?>

<br>
<link rel="stylesheet" href="styling.css">

</body>


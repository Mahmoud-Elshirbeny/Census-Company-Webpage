<?php
    session_start();
    if (!isset($_SESSION['email'])||!($_SESSION['type']=="employee")){
        header("Location: index.php");
    }
    echo"<br><br>";
    echo "Hello, Employee: " .  $_SESSION['name'];
?>
<head>
    <title>Employee</title>
    <link rel="stylesheet" href="styling.css">

</head>
<br><br>
<button onclick='location.href="logout.php"'>Log Out</button>
<br><br>
<body>
    <table>
    <tr><th>Please choose one of the following</tr></th>

    <form action="employeeHelper" method="post">
    <tr><td>    <input type="radio" id="same address" name="query" value="sameAddress">
        <label>Number/Names of people living at the same address</label>
        <input type="text" name="add" placeholder="Address"> </tr></td>

    <tr><td>    <input type="radio" id="no of m/f" name="query" value="malesANDfemales">
        <label>Number of males and females</label> </tr></td>

    <tr><td>    <input type="radio" id="same city" name="query" value="sameCity">
        <label>Number/Names of individuals living in the same city/governorate</label>
        <input type="text" name="city" placeholder="City/Government"> </tr></td>

    <tr><td>    <input type="radio" id="same city" name="query" value="birthDate">
        <label>Number/Names of people having a particular birth date :</label> 
        <input type="date" name="dob"></tr></td>

    <tr><td>    <input type="radio" id="same city" name="query" value="academicDegree">
        <label>Number/Names of citizens having a certain academic degree</label>
        <input type="text" name="deg" placeholder="Academic degree"> </tr></td>

        <tr><td><input type="submit" name='go'></tr></td>
    </form>
</table>



</body>
<?php
    session_start();
    if (!isset($_SESSION['email'])||!($_SESSION['type']=="representative")){
        header("Location: index.php");
    }
    echo"<br><br>";
    echo "Hello, Representative: ".  $_SESSION["name"];
    
?>
<head>
    <title>Representative</title>
    <link rel="stylesheet" href="styling.css">

</head>
<br><br><button onclick='location.href="logout.php"'>Log Out</button><br><br>

<button onclick='location.href="familyEntry.php"'>Enter Family Data</button>
<button onclick='location.href="individualEntry.php"'>Enter Individual Data</button>

<br>
<br>

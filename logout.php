<?php
    session_start();

    session_destroy();

    header("Location: index.php");
?>

<head>
    <title>Logout</title>
    <link rel="stylesheet" href="styling.css">

</head>
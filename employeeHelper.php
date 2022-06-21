<?php
    session_start();
    if (!isset($_SESSION['email'])||!($_SESSION['type']=="employee")){
        header("Location: index.php");
    }
    echo"<br><br>";
    echo "Hello, Employee: ".  $_SESSION['name'];
?>
<head>
    <title>Query Result</title>
    <link rel="stylesheet" href="styling.css">

</head>
<br><br>
<button onclick='location.href="logout.php"'>Log Out</button>  
<button onclick='location.href="employee.php"'>Go back</button>
<br><br>
<p>Query Results: </P>


<?php
    $link = mysqli_connect("localhost", "root", "");
    if (!$link) {
        die('Connect Error (' . mysqli_connect_errno() . ')' . my_sqli_connect_error());
    } else {

        mysqli_query($link, "CREATE DATABASE Company");
        mysqli_select_db($link, "Company");
                

        if (isset($_POST['go'])) {
            if (!isset($_POST['query'])) {  
                echo "please choose one of the radio buttons";
            } else if ($_POST['query'] == "sameAddress") {
                if (!$_POST['add']) {
                    echo "Please enter the address";
                } else {
                    $names =  mysqli_query($link, "SELECT namev  FROM Families , Individuals where Families.FamilyID = Individuals.FamilyID and addressv='$_POST[add]' ");
                    echo "<table border=1>";
                    echo "<tr><th colspan='2'>Names</th></tr>";
                    while($row = mysqli_fetch_array($names)){
                        echo "<tr><td colspan='2'>" . $row['namev'] . "</td></tr>";
                    }
                mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

                    $result = mysqli_query($link, "SELECT count(*) as sum  FROM Families , Individuals where Families.FamilyID = Individuals.FamilyID and Families.addressv='$_POST[add]' ");
                    $row = mysqli_fetch_array($result);
                    echo "<tr><th>Total Number:</th>";
                    echo "<td>" . $row['sum'] . "</td></tr>";
                    echo "</table>";
                }


            } else if ($_POST['query'] == "malesANDfemales") {
                mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
                $result = mysqli_query($link, "SELECT count(sex) as Males FROM Individuals where sex='male' ");
                $result2 = mysqli_query($link, "SELECT count(sex) as Females FROM Individuals where sex='female' ");

                echo "<table border=1>";
                $row = mysqli_fetch_array($result);
                $row2 = mysqli_fetch_array($result2);
                echo "<tr><th>Males</th> <th>Females</th>";
                echo "<tr><td>" . $row['Males'] . "</td>";
                echo "<td>" . $row2['Females'] . "</td></tr>";

                echo "</table>";



            } else if ($_POST['query'] == "sameCity") {
                if (!$_POST['city']) {
                    echo "Please enter the city or governorate";
                } else {
                    $names =  mysqli_query($link, "SELECT namev  FROM Families , Individuals where Families.FamilyID = Individuals.FamilyID and cityOrgov='$_POST[city]' ");
                    echo "<table border=1>";
                    echo "<tr><th colspan='2'>Names</th></tr>";
                    while($row = mysqli_fetch_array($names)){
                        echo "<tr><td colspan='2'>" . $row['namev'] . "</td></tr>";
                    }

                    $result = mysqli_query($link, "SELECT count(*) as sum  FROM Families , Individuals where Families.FamilyID = Individuals.FamilyID and cityOrgov='$_POST[city]'  ");
                    $row = mysqli_fetch_array($result);
                    echo "<tr><th>Total Number:</th>";
                    echo "<td>" . $row['sum'] . "</td></tr>";
                    echo "</table>";
                }


            }else if ($_POST['query'] == 'birthDate') {
                if (!$_POST['dob']) {
                    echo "Please enter the date of birth";
                } else {
                    $names =  mysqli_query($link, "SELECT namev  FROM Families , Individuals where Families.FamilyID = Individuals.FamilyID and dob='$_POST[dob]'");
                    echo "<table border=1>";
                    echo "<tr><th colspan='2'>Names</th></tr>";
                    while($row = mysqli_fetch_array($names)){
                        echo "<tr><td colspan='2'>" . $row['namev'] . "</td></tr>";
                    }

                    $result = mysqli_query($link, "SELECT count(*) as sum  FROM Families , Individuals where Families.FamilyID = Individuals.FamilyID and dob='$_POST[dob]'  ");
                    $row = mysqli_fetch_array($result);
                    echo "<tr><th>Total Number:</th>";
                    echo "<td>" . $row['sum'] . "</td></tr>";
                    echo "</table>";
                }
            
            } else if ($_POST['query'] == "academicDegree") {
                if (!$_POST['deg']) {
                    echo "Please enter the academic degree";
                } else {
                    $names =  mysqli_query($link, "SELECT namev  FROM Families , Individuals where Families.FamilyID = Individuals.FamilyID and academic_degree='$_POST[deg]' ");
                    echo "<table border=1>";
                    echo "<tr><th colspan='2'>Names</th></tr>";
                    while($row = mysqli_fetch_array($names)){
                        echo "<tr><td colspan='2'>" . $row['namev'] . "</td></tr>";
                    }

                    $result = mysqli_query($link, "SELECT count(*) as sum  FROM Families , Individuals where Families.FamilyID = Individuals.FamilyID and academic_degree='$_POST[deg]'  ");
                    $row = mysqli_fetch_array($result);
                    echo "<tr><th>Total Number:</th>";
                    echo "<td>" . $row['sum'] . "</td></tr>";
                    echo "</table>";
                }

            } 
        }
    }
    ?>


<?php
    session_start();
    if (!isset($_SESSION['email'])||!($_SESSION['type']=="representative")){
        header("Location: index.php");
    }
    echo"<br><br>";
    echo "Hello, Rep: ".  $_SESSION['name'];
?>

<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Individual Entry</title>
    <link rel="stylesheet" href="styling.css">   
    <br><br>
<button onclick='location.href="logout.php"'>Log Out</button><button onclick='location.href="representative.php"'>Go back</button>
<br><br>
</head>
<body>
<form action = "" method="post">
    <div class="main-page">
        <div class="sub-page">
            <h1 align='center'>Data Form</h1>
            <p id="response"></p>
            <fieldset>
                <legend><b>Personal Details</b></legend>
                <table>
                    <tr><th>Name: </th><td><input type="text" placeholder="Enter Name Here" name="name"></td></tr>
                    
                    <tr><th>National ID Number: </th><td><input type="number" placeholder="Enter ID Number Here" name="nationalID"></td></tr>

                    <tr><th>Family ID: </th><td><input type="number" placeholder="(If none enter 0)" name = "familyID"></td></tr>
                    
                    <tr><th>Phone Number: </th><td><input type="number" placeholder="Enter 11 Digit Number" name="mobile"></td></tr>
                    
                    <tr><th>Gender: </th>
                    
                        <td>
                            <input type="radio" id="male" name="gender" value="Male">
                            <label>Male</label><br>
                            <input type="radio" id="female" name="gender" value="Female">
                            <label>Female</label><br>
                            <input type="radio" id="other" name="gender" value="Other">
                            <label>Other</label>
                        </td>
                    </tr>
                    
                    <tr><th>Date of Birth: </th><td><input type="date" id="birthday" name="dateOfBirth"></td></tr>
                </table>
            </fieldset>
            <br />
            <fieldset>
                <table>
                    <tr><th>Marital Status: </th>
                        <td>

                            <input type="radio" id="single" name="stat" value="Single">
                            <label>Single</label><br>
                            <input type="radio" id="married" name="stat" value="Married">
                            <label>Married</label><br>
                            <input type="radio" id="comp" name="stat" value="Compicated">
                            <labe>Complicated</label><br>
                            <input type="radio" id="comp" name="stat" value="Sad">
                            <labe>Stalking my ex at 4 am through an unblocked account</label><br>
                        </td>
                    </tr>
                </table>
            </fieldset>
            <br />
            <fieldset>
                <table>
                    <tr>
                        <th>
                            <label for="edu">Academic Degree:</label></th><td>
                            <input type="text" placeholder="Your Degree" name="degree">
                        </td>
                    </tr>
                    <tr><th>Job Title: </th><td><input type="text" placeholder="Enter Job Title Here" name="job"></td></tr>
                </table>
            </fieldset>
            <br />
            <div class="div1">
                <input type="submit"  name = "submitted">
                <div id="textt"></div>
            </div>
        </div>
        
    </div>
</form>



<br>


<?php
if(isset($_POST['submitted'])){
    if(!$_POST['name'] || !$_POST['dateOfBirth'] || (!$_POST['familyID']&&!($_POST['familyID']==0)) || empty($_POST['gender'])|| !$_POST['nationalID'] || empty($_POST['stat'])|| !$_POST['mobile']|| !$_POST['degree']|| !$_POST['job']){
        echo "<script>document.getElementById('response').innerHTML='Please Complete The Information.'</script>";
    }
    else{
    $name = $_POST["name"];
    $gender = $_POST["gender"];
    $familyID = $_POST["familyID"];
    $dateOfBirth = $_POST["dateOfBirth"];
    $nationalID = $_POST["nationalID"];
    $maritalStatus = $_POST["stat"];
    $mobile = $_POST["mobile"];
    $degree = $_POST["degree"];
    $job = $_POST["job"];
    


    $link = mysqli_connect("localhost", "root", "");
    if (!$link) {
        die('Connect Error (' . mysqli_connect_errno() . ')' . my_sqli_connect_error());
    } else {
        mysqli_query($link,"CREATE DATABASE Company");
        mysqli_select_db($link,"Company");
        if (mysqli_num_rows( mysqli_query($link, "SELECT * FROM Families WHERE FamilyID = $familyID "))==0) {
            echo "<script>document.getElementById('response').innerHTML='Family ID incorrect. Enter data again.'</script>";
        }else{
        $insert = mysqli_query($link, "INSERT INTO Individuals VALUES('$name','$gender','$dateOfBirth','$nationalID','$maritalStatus','$mobile','$degree','$job',$familyID)");
        if(!$insert || (mysqli_affected_rows($link))==0){
            echo"<script>document.getElementById('response').innerHTML='Error'</script>";
            echo mysqli_error($link);
        }
    
        else{
            echo"<script>document.getElementById('response').innerHTML='Success'</script>";
        }
    }
        
        
    }


}}
?>


</body>
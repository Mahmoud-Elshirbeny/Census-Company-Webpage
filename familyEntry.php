<?php
    session_start();
    if (!isset($_SESSION['email'])||!($_SESSION['type']=="representative")){
        header("Location: index.php");
    }
    echo"<br><br>";
    echo "Hello, Representative: ".  $_SESSION["name"];
    
?>
<head>
    <title>Family Entry</title>
    <link rel="stylesheet" href="styling.css">

</head> 
    <br><br>
<button onclick='location.href="logout.php"'>Log Out</button><button onclick='location.href="representative.php"'>Go back</button>
<br><br>
</head>
<body>
    <div class="main-page">
        <div class="sub-page">
            <form action="" method="post">
            <h1 align='center'>Family Data Form</h1>
            <p id="response"></p>
            <fieldset>
                <legend><b>Details</b></legend>
                <table>
                    <tr><th>Name: </th><td><input type="text" placeholder="Enter Name Here" name="name"></td></tr>
                    <tr><th>ID: </th><td><input type="number" placeholder="Enter Family ID" name="familyID"></td></tr>
                    <tr><th>Address: </th><td><input type="text" placeholder="Enter Address" name = "address"></td></tr>
                    <tr><th>City or Gov: </th><td><input type="text" placeholder="Enter City/Gov" name = "city"></td></tr>
                    <tr><th>Phone Number: </th><td><input type="number" placeholder="Enter Number" name="number"></td></tr>
                    <tr><th>Number of Members in the Family: </th><td><input type="number" placeholder="Enter Number of Members" name="familyCount"></td></tr>
                    </table>
            </fieldset>
            <br />
         
            <div class="div1">
                <input type="submit" value = "Submit" name="submitted">
            </div>

            
</form>
        </div>
    </div>
    
</body>

<?php
    if(isset($_POST['submitted'])){
        if(!$_POST['name'] || !$_POST['familyID'] || !$_POST['address'] || !$_POST['city']|| !$_POST['number']|| !$_POST['familyCount']){
            echo "<script>document.getElementById('response').innerHTML='Please Complete Info'</script>";
        }
        else{
        $name = $_POST["name"];
        $familyID = $_POST["familyID"];
        $address = $_POST["address"];
        $city = $_POST["city"];
        $number = $_POST["number"];
        $familyCount = $_POST["familyCount"]; 
    
        $link = mysqli_connect("localhost", "root", "");
        if (!$link) {
            die('Connect Error (' . mysqli_connect_errno() . ')' . my_sqli_connect_error());
        } else {
            mysqli_query($link,"CREATE DATABASE Company");
            mysqli_select_db($link,"Company");

            if (mysqli_num_rows( mysqli_query($link, "SELECT * FROM Families WHERE FamilyID = $familyID "))!=0) {
                echo "<script>document.getElementById('response').innerHTML='This family ID already exists, please choose another ID'</script>";
          }
            else{
            $insert = mysqli_query($link, "INSERT INTO Families values($familyID,'$name','$address','$city','$number',$familyCount)");
            if(!$insert || (mysqli_affected_rows($link))==0){
                echo"<script>document.getElementById('response').innerHTML='Error'</script>";
                
                echo '<br>'.mysqli_error($link);
            }
        
            else{
                echo"<script>document.getElementById('response').innerHTML='Success'</script>";
            }
        }
            
        }
    
    
    }}
?>

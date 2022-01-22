<html>
<head>
<style>
.errorColor {color: #D30000;}
</style>
</head>
<body>  
<?php
// all required variables defined here
$nameError = $emailError = $phonenoError ="";
$name = $email = $phoneno = $submited = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameError = "Name is mandatory";
  } else {
    $name = test_input($_POST["name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
      $nameError = "Only letters allowed";
    }
  }
  
  if (empty($_POST["email"])) {
    $emailError = "Email is mandatory";
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailError = "Invalid email format";
    }
  }
    
 if (empty($_POST["phoneno"])) {
    $phonenoError = "phoneno is mandatory";
  } else {
    $name = test_input($_POST["phoneno"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^\d(10)+$/",$phoneno)) {
      $phonenoError = "Only number allowed";
    }
  }
  
  $submit = test_input($_POST["submit"]);
}

function test_input($data) {
  $data = trim($data);   
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "formdb";
  
  // I am Creating a connection here with MySQL.
  $conn = mysqli_connect($servername, $username, $password, $dbname);
  
  // I am Checking connection here. 
  if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }
    
  // SQL query to inserting data in students table.

  $sql = "INSERT INTO inquiry_table (name, email, phoneno)
  VALUES ('$name', '$email', '$phoneno')";
  
 (mysqli_query($conn, $sql)); 
    
  mysqli_close($conn);
  
?>

<!-- Creating a Form -->
<style type="text/css">
	.first{
	
		text-align:center;
		
		
	} 
	.SECOND{
background-color:#F8F8FF;
 position: absolute;
  left:300px;
  width: 500px;
  height: 500px;	}
	
		
	</style>
<form method="post"> 
   
   <fieldset class="SECOND" ><div class="first">
   <legend> <b> <h1>YOUR DETAILS</h1> </b></legend>  
<h2><u>PHP Form With Validation</u></h2>
<p><span class="errorColor">* mandatory field</span></p>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  <div class="first">
  Name: <input type="text" name="name">
  <span class="errorColor">* <?php echo $nameError;?></span></div>
  <br><br>
  <div class="first">
  E-mail: <input type="text" name="email">
  <span class="errorColor">* <?php echo $emailError;?></span></div>
  <br><br>
  <div class="first">
  Phoneno: <input type="text" name="phoneno">
  <span class="errorColor">* <?php echo $phonenoError;?></span></div>
  <br><br>
  
 
<input type="hidden" name="submited" value="Details sent successfully">
<input type="submit" name="submit" value="Submit">   
</form>





<?php
if ($nameError =="Name is mandatory"){
echo "Error";
}else{
echo $submited; 
}
?>

</body>
</html>
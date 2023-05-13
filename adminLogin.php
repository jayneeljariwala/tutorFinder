<!DOCTYPE html>
<?php
    session_start();
    include("dbCon.php");
    if(isset($_POST['login'])){
      $uName = $_POST['uname'];
      $pass = $_POST['psw'];
      $qry = "select * from admintb where (uname = '$uName' or email = '$uName') and pass = '$pass'";
      $res = mysqli_query($con, $qry);
      $count = mysqli_affected_rows($con);
      $dbArray = mysqli_fetch_array($res);
      if($count > 0)
      {
        $_SESSION['aid'] = $dbArray[0];
        $_SESSION['adminName'] = $dbArray[1];
        $_SESSION['adminMail'] = $dbArray[2];
        header("Location: Home/adminHome.php");
      }
      else
      {
        ?>
          <script>
            alert("Invalid Username or Password");
          </script>
        <?php
        mysqli_close($con);
      }
    }
?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
<style>
body {
    font-family: Arial, Helvetica, sans-serif; 
    background-color: rgb(46,39,92);
}

h2{
    color: lightgreen;
}

input[type=text], input[type=password] {
  width: 60%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

.btn {
  background-color: #04AA6D;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 30%;
}

.btn:hover {
  opacity: 0.8;
}

.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
}

img.avatar {
  width: 15%;
  border-radius: 50%;
}

.container {
  padding: 16px;
}

span.psw {
  float: right;
  padding-top: 16px;
}

.frmClass{
    background-color: rgb(193, 214, 247);
    width: 700px;
    border-radius: 25px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
    display: block;
    float: none;
  }
}
</style>
</head>
<body>
    
<center>
<h2><b><u>Login As Admin</u></b></h2>
</center>

<form method="post">
    <div class="imgcontainer">
      <img src="images/admin.png" alt="Avatar" class="avatar">
    </div>
      <center>
    <div class="container frmClass">
      <label for="uname"><b>Username</b></label>
      <input type="text" placeholder="Enter Username" name="uname" required><br>

      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="psw" required><br>
          
      <input name="login" class="btn" type="submit" value="Login"/>
    </div>
  </center>
</form>
</body>
</html>
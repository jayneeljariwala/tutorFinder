<?php
    session_start();
    include('dbCon.php');
    if(isset($_POST['register']))
    {
        $regfname = $_POST['registerfname'];
        $reglname = $_POST['registerlname'];
        $regemail = $_POST['registeremail'];
        $regpass = $_POST['registerpsw'];
        $regconfpass = $_POST['registerconfpsw'];
        $regmob = $_POST['registermob'];
        $regaddr = $_POST['registeraddr'];
        $regcity = $_POST['registercity'];
        $regdate = date('Y/m/d H:i:s');
        $regstatus = 2;

        if($_POST['registercaptcha'] == $_SESSION['code'])
        {   
            $sql = "select * from studenttb where email = '$regemail'";
            $res = mysqli_query($con, $sql);
            $count = mysqli_affected_rows($con);
            if($count > 0)
            {
                ?>
                    <script>
                        alert("This Email is already registered...");
                    </script>
                <?php
            }
            else
            {
                if($regpass != $regconfpass)
                {
                    ?>
                        <script>
                            alert("Confirm password is not matched with password field...")
                        </script>
                    <?php
                }
                else
                {
                    $sqlIns = "insert into studenttb(fname, lname, email, pass, mobno, address, cityID, regDate, statusID) values('$regfname', '$reglname', '$regemail', '$regpass', '$regmob', '$regaddr', '$regcity', '$regdate', '$regstatus')";
                    $resIns = mysqli_query($con, $sqlIns);
                    $countIns = mysqli_affected_rows($con);
                    
                    if($countIns > 0)
                    {
                        ?>
                            <script>
                                alert("You are registered successfully...");
                            </script>
                        <?php
                         $sidSql = "select * from studenttb where email = '$regemail'";
                         $sidRes = mysqli_query($con, $sidSql);
                         $sidRow = mysqli_fetch_array($sidRes);
                         $rateSid = $sidRow[0];
                         $tidSql = "select tid from tutortb";
                         $sqlRes = mysqli_query($con, $tidSql);
 
                         while($tidRow = mysqli_fetch_array($sqlRes))
                         {
                             $tid = $tidRow[0];
                             $sql2 = "insert into ratingtb(tid, sid) values($tid, $rateSid)";
                             $insRes = mysqli_query($con, $sql2);
                         }
                    }
                    else
                    {
                        ?>
                            <script>
                                alert("Error occurred during registration...");
                            </script>
                        <?php
                    }
                }
            }
        }
        else
        {
            ?>
                <script>
                    alert("Incorrect code, Please submit again...");
                </script>
            <?php
        }
    }
    if(isset($_POST['login']))
    {
        $loginemail = $_POST['loginemail'];
        $loginpass = $_POST['loginpsw'];

        $loginqry = "select * from studenttb where email = '$loginemail' and pass = '$loginpass'";
        $loginres = mysqli_query($con, $loginqry);
        $logincount = mysqli_affected_rows($con);

        if($logincount == 0)
        {
            ?>
                <script>
                    alert("User not found...");
                </script>
            <?php
        }
        else
        {
            $userDetail = mysqli_fetch_array($loginres);
            $_SESSION['sid'] = $userDetail[0];
            $lgnsid = $userDetail[0];
            $_SESSION['sfName'] = $userDetail[1];
            $_SESSION['slName'] = $userDetail[2];
            $_SESSION['spic'] = $userDetail[3];
            $_SESSION['smail'] = $userDetail[4];
            $_SESSION['smob'] = $userDetail[6];
            $_SESSION['saddress'] = $userDetail[7];
            $_SESSION['scityid'] = $userDetail[8];
            $lgndate = date('Y/m/d H:i:s');
            $lgnupdate = "update studenttb set loginDate='$lgndate', statusID=1 where sid=$lgnsid";
            $lgnres = mysqli_query($con, $lgnupdate);
            $count = mysqli_affected_rows($con);
            if($count > 0)
            {
                header("Location:Home/studentHome.php");
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif; 
            background: rgb(63,94,251);
            background: linear-gradient(90deg, rgba(63,94,251,1) 0%, rgba(252,70,107,1) 99%);
            background-repeat: no-repeat;
            background-attachment: fixed;
            padding-bottom: 70px;
        }

        h2{
            color: lightgreen;
        }

        input[type=text], input[type=password], input[type=email], input[type=tel] {
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
    span
    {
        color: blue;
        cursor: pointer;
    }
    .register
    {
        display: none;
    }
    form
    {
        margin-top: 100px;
    }
    img{
        height: 75px;
    }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $(".loginSpan").click(function(){
            $(".login").hide();
            $(".register").show();
        });
        $(".registerSpan").click(function(){
            $(".register").hide();
            $(".login").show();
        });
    });
</script>
</head>
<body>
<form method="post" class="login">
<center>
    <div class="container frmClass">
        <h1>Login As A Student</h1>
      <label for="loginemail"><i class='fas fa-user-alt' style='font-size:24px'></i></label>
      <input type="email" placeholder="Enter Email" name="loginemail" required><br>

      <label for="loginpsw"><i class='fas fa-lock' style='font-size:24px'></i></label>
      <input type="password" placeholder="Enter Password" name="loginpsw" required><br>
          
      <input name="login" class="btn" type="submit" value="Login"/><br/>
      Not registered yet ? <span class="loginSpan">Register</span>
    </div>
  </center>
</form>
<form method="post" class="register">
<center>
    <div class="container frmClass">
        <h1>Register As A Student</h1>
      <label for="registerfname"><i class='fas fa-address-card' style='font-size:24px'></i></label>
      <input type="text" placeholder="Enter Firstname" name="registerfname" required><br>

      <label for="registerlname"><i class='far fa-address-card' style='font-size:24px'></i></label>
      <input type="text" placeholder="Enter Lastname" name="registerlname" required><br>

      <label for="registeremail"><i class='fas fa-mail-bulk' style='font-size:24px'></i></label>
      <input type="email" placeholder="Enter Email" name="registeremail" required><br>

      <label for="registerpsw"><i class='fas fa-lock' style='font-size:24px'></i></label>
      <input type="password" placeholder="Enter Password" name="registerpsw" required><br>
          
      <label for="registerconfpsw"><i class='fas fa-user-lock' style='font-size:24px'></i></label>
      <input type="password" placeholder="Re-Enter Password" name="registerconfpsw" required><br>

      <label for="registermob"><i class='fas fa-mobile-alt' style='font-size:24px'></i></label>
      <input type="tel" placeholder="Enter Mobile number" name="registermob" pattern="[1-9]{1}[0-9]{9}" required><br>
      
      <label for="registeraddr"><i class='material-icons' style='font-size:24px'>location_on</i></label>
      <input type="text" placeholder="Enter Address" name="registeraddr" required><br>

      <label for="registercity"><i class='fas fa-city' style='font-size:24px'></i> <b>Select City :- </b></label>
      <select name="registercity">
        <?php
            $citysql = "select * from citymaster";
            $cityres = mysqli_query($con, $citysql);
            $count = mysqli_affected_rows($con);
            if($count > 0)
            {
                while($cityrow = mysqli_fetch_array($cityres))
                {
                    ?>
                        <option value="<?php echo $cityrow[0]; ?>"><?php echo $cityrow[1]; ?></option>
                    <?php
                }
            }
        ?>
      </select><br>

      <img src="captcha.php"><br>

      <label for="registercaptcha"><i class='fas fa-fingerprint' style='font-size:24px'></i></label>
      <input type="text" placeholder="Enter Above Code" name="registercaptcha" required><br>
        
      <input name="register" class="btn" type="submit" value="Register"/><br/>
      Already Registered ? <span class="registerSpan">Login</span>
    </div>
  </center>
</form>
</body>
</html>
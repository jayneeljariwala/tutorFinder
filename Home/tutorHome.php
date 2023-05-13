<?php
    session_start();
    include("../dbCon.php");
    $tid = $_SESSION['tid'];

    $fetchQuery = "select * from tutortb where tid = $tid";
    $result = mysqli_query($con, $fetchQuery);
    while($row = mysqli_fetch_array($result))
    {
      $fname = $row[1];
      $lname = $row[2];
      //$sub1 = $row[4];
      // if($row[5] == '')
      // {
      //   $sub2 = '-';
      // }
      // else
      // {
      //   $sub2 = $row[5];
      // }
      // if($row[6] == '')
      // {
      //   $sub3 = '-';
      // }
      // else
      // {
      //     $sub3 = $row[6];
      // }
      $email = $row[5];
      $pass = $row[6];
      $mob = $row[7];
      $quali = $row[8];
      $address = $row[9];
      $cityID = $row[10];
      // $charge = $row[13];
      // $_SESSION['sub1'] = $sub1;
      // $_SESSION['sub2'] = $sub2;
      // $_SESSION['sub3'] = $sub3;
    }
    if(isset($_POST['uploadPic']))
    {
      $src = $_FILES['uploadfile']['tmp_name'];
      $dest = "../images/".$_FILES['uploadfile']['name'];
      if(move_uploaded_file($src,$dest))
      {
        $_SESSION['tpic'] = $dest;
        $tid = $_SESSION['tid'];
        $sql = "update tutortb set pic = '$dest' where tid = $tid";
        $res = mysqli_query($con,$sql);
        $count = mysqli_affected_rows($con);
        if($count > 0)
        {
          header("location:tutorHome.php");
        }
        else
        {
          ?>
            <script>
              alert("Error in uploading a pic");
            </script>
          <?php
        }
      }
    }
    if(isset($_POST['updateRecord']))
    {
      $tid = $_SESSION['tid'];
      $fname = $_POST['fname'];
      $lname = $_POST['lname'];
      $email = $_POST['email'];
      $pass = $_POST['psw'];
      $mob = $_POST['mob'];
      $quali = $_POST['qual'];
      $address = $_POST['addr'];
      $city = $_POST['city'];
      $updateSql = "update tutortb set fname='$fname', lname='$lname', email='$email', pass='$pass', mobno='$mob', qual='$quali',address='$address', cityID='$city' where tid=$tid";
      $result = mysqli_query($con, $updateSql);
      $count = mysqli_affected_rows($con);
      if($count > 0)
      {
        $_SESSION['tcityid'] = $city;
        ?>
          <script>
                alert("Record Updated Successfully...");
          </script>
        <?php
      }
      else
      {
        ?>
          <script>
                alert("Error...");
          </script>
        <?php
      }
    }
    if(isset($_POST['logout']))
    {
      unset($_SESSION['tid']);
      header("Location: ../tutorLogin.php");
    }
    if(isset($_POST['updateSubject']))
    {
      $fee = $_POST['fee'];
      $sub = $_POST['sub'];
      $sql = "update tutortb set subID='$sub', fee=$fee where tid=$tid";
      $subResult = mysqli_query($con, $sql);
      $count = mysqli_affected_rows($con);
      if($count > 0)
      {
        $_SESSION['tfee'] = $fee;
        $_SESSION['subid'] = $sub;
        ?>
          <script>
            alert("Subject Detail modified...");
          </script>
        <?php
      }
      else
      {
        ?>
          <script>
            alert("Error...");
          </script>
        <?php
      }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tutor Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <style>
        .homeNav{
            background-color: gray;
        }
        .edit, .sub, .mail, .req, .mystud{
          display: none;
        }
        body{
          background: linear-gradient(to bottom, #ffffff 0%, #99ccff 100%);
          background-repeat: no-repeat;
          background-attachment: fixed;
        }
        img.avatar {
          width: 200px;
          height: 200px;
          border-radius: 50%;
        }
        .imgcontainer {
          text-align: center;
          margin: 80px 0 12px 0;
        }
        .uploadbtn{
          width: 200px;
          height: 40px;
          font-size: 20px;
          line-height: 35px;
          background-color: none;
          border: solid 2px gray;
          cursor: pointer;
          border-radius: 20px;
        }
        input[type=text], input[type=password], input[type=email], input[type=tel] {
          width: 60%;
          padding: 12px 20px;
          margin: 8px 0;
          display: inline-block;
          border: 1px solid #ccc;
          box-sizing: border-box;
        }
        .uploadbtn:hover{
          background-color: gray;
        }
        
        .frmClass{
            background-color: rgb(131, 171, 294);
            width: 700px;
            border-radius: 25px;
            margin-top: 50px;
            margin-bottom: 50px;
        }
        .container {
          padding: 16px;
        }
        .updatebtn {
          background-color: #04AA6D;
          color: white;
          padding: 14px 20px;
          margin: 8px 0;
          border: none;
          cursor: pointer;
          width: 30%;
        }

        .updatebtn:hover {
          opacity: 0.8;
        }

        @media only screen and (max-width:575px) {
          .frmClass{
            background-color: rgb(131, 171, 294);
            width: 400px;
            border-radius: 25px;
            margin-top: 50px;
            margin-bottom: 50px;
          }
        }
        a{
          text-decoration: none;
          color: white;
        }
        a:hover{
          color: black;
        }
    </style>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script>
      $(document).ready(function(){
        $(".editNav").click(function(){
          $(".home").hide();
          $(".sub").hide();
          $(".edit").show();
          $(".mail").hide();
          $(".req").hide();
          $(".mystud").hide();
          $(".homeNav").css("background-color", "rgb(33, 37, 41)");
          $(".subNav").css("background-color", "rgb(33, 37, 41)");
          $(".emailNav").css("background-color", "rgb(33, 37, 41)");
          $(".reqNav").css("background-color", "rgb(33, 37, 41)");
          $(".editNav").css("background-color", "gray");
          $(".mystudNav").css("background-color", "rgb(33, 37, 41)");
        });
        $(".homeNav").click(function(){
          $(".home").show();
          $(".sub").hide();
          $(".edit").hide();
          $(".mail").hide();
          $(".req").hide();
          $(".mystud").hide();
          $(".homeNav").css("background-color", "gray");
          $(".subNav").css("background-color", "rgb(33, 37, 41)");
          $(".emailNav").css("background-color", "rgb(33, 37, 41)");
          $(".reqNav").css("background-color", "rgb(33, 37, 41)");
          $(".editNav").css("background-color", "rgb(33, 37, 41)");
          $(".mystudNav").css("background-color", "rgb(33, 37, 41)");
        });
        $(".subNav").click(function(){
          $(".home").hide();
          $(".sub").show();
          $(".edit").hide();
          $(".mail").hide();
          $(".req").hide();
          $(".mystud").hide();
          $(".homeNav").css("background-color", "rgb(33, 37, 41)");
          $(".subNav").css("background-color", "gray");
          $(".emailNav").css("background-color", "rgb(33, 37, 41)");
          $(".reqNav").css("background-color", "rgb(33, 37, 41)");
          $(".editNav").css("background-color", "rgb(33, 37, 41)");
          $(".mystudNav").css("background-color", "rgb(33, 37, 41)");
        });
        $(".emailNav").click(function(){
          $(".home").hide();
          $(".sub").hide();
          $(".edit").hide();
          $(".mail").show();
          $(".req").hide();
          $(".mystud").hide();
          $(".homeNav").css("background-color", "rgb(33, 37, 41)");
          $(".subNav").css("background-color", "rgb(33, 37, 41)");
          $(".emailNav").css("background-color", "gray");
          $(".reqNav").css("background-color", "rgb(33, 37, 41)");
          $(".editNav").css("background-color", "rgb(33, 37, 41)");
          $(".mystudNav").css("background-color", "rgb(33, 37, 41)");
        });
        $(".reqNav").click(function(){
          $(".home").hide();
          $(".sub").hide();
          $(".edit").hide();
          $(".mail").hide();
          $(".req").show();
          $(".mystud").hide();
          $(".homeNav").css("background-color", "rgb(33, 37, 41)");
          $(".subNav").css("background-color", "rgb(33, 37, 41)");
          $(".emailNav").css("background-color", "rgb(33, 37, 41)");
          $(".reqNav").css("background-color", "gray");
          $(".editNav").css("background-color", "rgb(33, 37, 41)");
          $(".mystudNav").css("background-color", "rgb(33, 37, 41)");
        });
        $(".mystudNav").click(function(){
          $(".home").hide();
          $(".sub").hide();
          $(".edit").hide();
          $(".mail").hide();
          $(".req").hide();
          $(".mystud").show();
          $(".homeNav").css("background-color", "rgb(33, 37, 41)");
          $(".subNav").css("background-color", "rgb(33, 37, 41)");
          $(".emailNav").css("background-color", "rgb(33, 37, 41)");
          $(".reqNav").css("background-color", "rgb(33, 37, 41)");
          $(".editNav").css("background-color", "rgb(33, 37, 41)");
          $(".mystudNav").css("background-color", "gray");
        });
      });
    </script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid table-responsive">
    <a class="navbar-brand" href="../index.php" target="_top">Online-Tutor-Finder</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active homeNav" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active editNav" href="#">Edit-Profile</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active subNav" href="#">Edit-Subject</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active emailNav" href="#">Show-Email</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active reqNav" href="#">Show-Request</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active mystudNav" href="#">My-Students</a>
        </li>
      </ul>
      <form class="d-flex" method="post" action=<?php echo $_SERVER['PHP_SELF']; ?>>
        <button class="btn btn-outline-success" name="logout" type="submit"><i class='fas fa-sign-out-alt' style='font-size'></i>Logout</button>
      </form>
    </div>
  </div>
</nav>
<div class="home">
  <center><br/>
  <h2><b><u>Welcome <?php echo $_SESSION['tfName'], " ", $_SESSION['tlName']; ?></u></b></h2>
  <div class="imgcontainer">
    <?php
      if($_SESSION['tpic'] == '')
      {
        $img = '../images/defaultStud.jpg';
      }
      else
      {
        $img = $_SESSION['tpic'];
      }
    ?>
    <img src=<?php echo $img; ?> alt="Avatar" class="avatar"><br/><br/><br/>
    <form enctype="multipart/form-data" method="post">
      <input type="file" name="uploadfile" id="img" style="display:none;"/>
      <label for="img" class="uploadbtn" onclick="toggle()" id="pic">
      <script>
        var display = "Choose-Pic";
        function toggle()
        {
          document.getElementById('pic').innerHTML = "Pic-Selected";
          document.getElementById('btn').style.pointerEvents = "auto";
        }
        document.write(display);
        </script>
      </label>&nbsp
      <button name="uploadPic" class="btn" id="btn"><i class="fas fa-upload" style="font-size: 25px"></i></button>
    </form>
  </div><br/>
  <h2>Hello <?php echo $_SESSION['tfName']; ?></h2>
  <h2>Email :- <?php echo $_SESSION['temail']; ?></h2>
  <?php
    $ratingsql = "select avg(r.rating) from ratingtb r, tutortb t where r.tid=t.tid and r.tid=$tid";
    $ratingres = mysqli_query($con, $ratingsql);
    $myrating = mysqli_fetch_array($ratingres)[0];

    if($myrating == 0)
    {
      ?>
        <h2>Not Rated Yet!</h2>
      <?php
    }
    else
    {
      ?>
        <h2>Your Rating :- <?php echo number_format($myrating, 1, '.', ''), "/5.0";?></h2>
      <?php
    }
  ?>
  </center>
</div>
<div class="edit">
  <form method="post" class="register">
  <center>
      <div class="container frmClass">
          <h1>Edit Tutor Profile</h1>
        <label for="fname"><i class='fas fa-address-card' style='font-size:24px'></i></label>
        <input type="text" placeholder="Enter Firstname" name="fname" value="<?php echo $fname;?>" required><br>

        <label for="lname"><i class='far fa-address-card' style='font-size:24px'></i></label>
        <input type="text" placeholder="Enter Lastname" name="lname"  value="<?php echo $lname;?>" required><br>

        <label for="email"><i class='fas fa-mail-bulk' style='font-size:24px'></i></label>
        <input type="email" placeholder="Enter Email" name="email"  value="<?php echo $email;?>" required><br>

        <label for="psw"><i class='fas fa-lock' style='font-size:24px'></i></label>
        <input type="password" placeholder="Enter Password" name="psw"  value="<?php echo $pass;?>" required><br>

        <label for="mob"><i class='fas fa-mobile-alt' style='font-size:24px'></i></label>
        <input type="tel" placeholder="Enter Mobile number" name="mob" pattern="[1-9]{1}[0-9]{9}"  value="<?php echo $mob;?>" required><br>
        
        <label for="qual"><i class='fas fa-graduation-cap' style='font-size:24px'></i></label>
        <input type="text" placeholder="Enter Qualification" name="qual"  value="<?php echo $quali;?>" required><br>

        <label for="addr"><i class='material-icons' style='font-size:24px'>location_on</i></label>
        <input type="text" splaceholder="Enter Address" name="addr"  value="<?php echo $address;?>" required><br>

        <label for="city"><i class='material-icons' style='font-size:24px'>location_city</i> <b>Select City :- </b></label>
        <select name="city">
          <?php
            $cityid = $_SESSION['tcityid'];
            $citysql = "select * from citymaster where cityID = $cityid";
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
            $citysql = "select * from citymaster where cityID <> $cityid";
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
        </select><br><br>
          
        <input name="updateRecord" class="updatebtn" type="submit" value="Update"/><br/>
      </div>
    </center>
  </form>
</div>
<div class="sub">
  <form method="post" class="register">
 <center>
   <div class="container frmClass">
        <h1>Edit Subject</h1>
        <label for="sub"><i class='fas fa-book' style='font-size:24px'></i> <b>Select Subject :- </b></label>
        <select name="sub">
          <?php
            $subid = $_SESSION['subid'];
            $subsql = "select * from subjectmaster where subID = $subid";
            $subres = mysqli_query($con, $subsql);
            $count = mysqli_affected_rows($con);
            if($count > 0)
            {
              while($subrow = mysqli_fetch_array($subres))
              {
                ?>
                  <option value="<?php echo $subrow[0]; ?>"><?php echo $subrow[1]; ?></option>
                <?php
              }
            }
            $subsql = "select * from subjectmaster where subID <> $subid";
            $subres = mysqli_query($con, $subsql);
            $count = mysqli_affected_rows($con);
            if($count > 0)
            {
              while($subrow = mysqli_fetch_array($subres))
              {
                ?>
                  <option value="<?php echo $subrow[0]; ?>"><?php echo $subrow[1]; ?></option>
                <?php
              }
            }
          ?>
        </select><br><br>

      <label for="fee"><i class='fas fa-money-bill-alt' style='font-size:24px'></i></label>
      <input type="text" placeholder="Enter Fee in ₹" name="fee" value="<?php echo $_SESSION['tfee']; ?>" required><br>
      
      <input name="updateSubject" class="updatebtn" type="submit" value="Edit-Details"/><br/>
    </div>
 </center>
    </form>
</div>
<div class="mail">
 email
</div>
<div class="req">
<center>
  <h1>Pending Requests</h1>
   <div class="container">
      <?php
        $reqsql = "select s.fname,s.lname,s.email,s.pic,s.address,c.cityName,rs.reqStatus,s.sid from studenttb s, requesttb rt, requeststatus rs, citymaster c, tutortb t where s.sid=rt.sid and s.cityID=c.cityID and rt.reqID=rs.reqID and rt.tid=t.tid and t.tid=$tid and rt.reqID=1";
        $reqres = mysqli_query($con, $reqsql);
        $reqcount = mysqli_affected_rows($con);
        if($reqcount > 0)
        {
          while($reqtut = mysqli_fetch_array($reqres))
          {
            ?>
              <div class="table-responsive">
                <table border=4 class='table'>
                  <tr>
                    <th rowspan="11">
                      <img src="<?php echo $reqtut[3];?>" alt="" height="380" width="260">
                    </th>
                  </tr>
                  <tr>
                    <th>Name :- </th>
                    <td><?php echo $reqtut[0], " " ,$reqtut[1]; ?></td>
                  </tr>
                  <tr>
                    <th>Email :- </th>
                    <td><?php echo $reqtut[2]; ?></td>
                  </tr>
                  <tr>
                    <th>Address :- </th>
                    <td><?php echo $reqtut[4]; ?></td>
                  </tr>
                  <tr>
                    <th>City :- </th>
                    <td><?php echo $reqtut[5]; ?></td>
                  </tr>
                  <tr>
                    <th>Request-Status :- </th>
                    <td><?php echo $reqtut[6]; ?></td>
                  </tr>
                    <tr>
                      <td><button class="btn btn-danger"><a href="rejectrequest.php?sid=<?php echo $reqtut[7]; ?>&tid=<?php echo $tid; ?>">Reject-Request</a></button></td>
                      <td><button class="btn btn-warning"><a href="acceptrequest.php?sid=<?php echo $reqtut[7]; ?>&tid=<?php echo $tid; ?>">Accept-Request</a></button></td>
                    </tr>
                  </table>
                </div>
              <?php
            }
          }
          else
          {
            echo "<html><br/><br/><center><h4>No Requests Available</h4></center></html>";
          }
      ?>
      <h1>Accepted Requests</h1>
      <?php
        $reqsql = "select s.fname,s.lname,s.email,s.pic,s.address,c.cityName,rs.reqStatus from studenttb s, requesttb rt, requeststatus rs, citymaster c, tutortb t where s.sid=rt.sid and s.cityID=c.cityID and rt.reqID=rs.reqID and rt.tid=t.tid and t.tid=$tid and rt.reqID=2";
        $reqres = mysqli_query($con, $reqsql);
        $reqcount = mysqli_affected_rows($con);
        if($reqcount > 0)
        {
          while($reqtut = mysqli_fetch_array($reqres))
          {
            ?>
              <div class="table-responsive">
                <table border=4 class='table'>
                  <tr>
                    <th rowspan="11">
                      <img src="<?php echo $reqtut[3];?>" alt="" height="380" width="260">
                    </th>
                  </tr>
                  <tr>
                    <th>Name :- </th>
                    <td><?php echo $reqtut[0], " " ,$reqtut[1]; ?></td>
                  </tr>
                  <tr>
                    <th>Email :- </th>
                    <td><?php echo $reqtut[2]; ?></td>
                  </tr>
                  <tr>
                    <th>Address :- </th>
                    <td><?php echo $reqtut[4]; ?></td>
                  </tr>
                  <tr>
                    <th>City :- </th>
                    <td><?php echo $reqtut[5]; ?></td>
                  </tr>
                  <tr>
                    <th>Request-Status :- </th>
                    <td><?php echo $reqtut[6]; ?></td>
                  </tr>
                  </table>
                </div>
              <?php
            }
          }
          else
          {
            echo "<html><br/><br/><center><h4>No Requests Available</h4></center></html>";
          }
      ?>
   </div>
 </center>
</div>
<div class="mystud">
<center>
   <div class="container">
      <?php
        $studsql = "select st.fname,st.lname,st.pic,st.email,st.address,st.mobno,c.cityName,st.sid from tutortb t, citymaster c, booktb b, studenttb st where b.sid=st.sid and t.tid=$tid and b.tid=t.tid and st.cityID=c.cityID";
        $studres = mysqli_query($con, $studsql);
        $studcount = mysqli_affected_rows($con);
        if($studcount > 0)
        {
          echo "<html><center><h1>My Students</h1></center></html>";
          while($studdata = mysqli_fetch_array($studres))
          {
            ?>
              <div class="table-responsive">
                <table border=4 class='table'>
                  <tr>
                    <th rowspan="11">
                      <img src="<?php echo $studdata[2];?>" alt="" height="380" width="260">
                    </th>
                  </tr>
                  <tr>
                    <th>Name :- </th>
                    <td><?php echo $studdata[0], " " ,$studdata[1]; ?></td>
                  </tr>
                  <tr>
                    <th>Email :- </th>
                    <td><?php echo $studdata[3]; ?></td>
                  </tr>
                  <tr>
                    <th>Mobile No :- </th>
                    <td><?php echo $studdata[5]; ?></td>
                  </tr>
                  <tr>
                    <th>Address :- </th>
                    <td><?php echo $studdata[4]; ?></td>
                  </tr>
                  <tr>
                    <th>City :- </th>
                    <td><?php echo $studdata[6]; ?></td>
                  </tr>
                    <tr>
                      <td><button class="btn btn-warning"><a href="removeStudent.php?sid=<?php echo $studdata[7]; ?>&tid=<?php echo $tid; ?>">Remove-Student</a></button></td> 
                    </tr>
                  </table>
                </div>
              <?php
            }
          }
          else
          {
            echo "<html><br/><br/><center><h1>No Student Found</h1></center></html>";
          }
      ?>
   </div>
 </center>
</div>
</body>
</html>
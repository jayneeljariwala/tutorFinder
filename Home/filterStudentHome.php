<?php
    session_start();
    include("../dbCon.php");
    $sid = $_SESSION['sid'];
    $fetchQuery = "select * from studenttb where sid = $sid";
    $result = mysqli_query($con, $fetchQuery);
    while($row = mysqli_fetch_array($result))
    {
      $fname = $row[1];
      $lname = $row[2];
      $email = $row[4];
      $pass = $row[5];
      $mob = $row[6];
      $address = $row[7];
      $city = $row[8];
    }
    if(isset($_POST['uploadPic']))
    {
      $src = $_FILES['uploadfile']['tmp_name'];
      $dest = "../images/".$_FILES['uploadfile']['name'];
      if(move_uploaded_file($src,$dest))
      {
        $_SESSION['spic'] = $dest;
        $sid = $_SESSION['sid'];
        $sql = "update studenttb set pic = '$dest' where sid = $sid";
        $res = mysqli_query($con,$sql);
        $count = mysqli_affected_rows($con);
        if($count > 0)
        {
          header("location:studentHome.php");
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
      $sid = $_SESSION['sid'];
      $fname = $_POST['fname'];
      $lname = $_POST['lname'];
      $email = $_POST['email'];
      $pass = $_POST['psw'];
      $mob = $_POST['mob'];
      $address = $_POST['addr'];
      $city = $_POST['city'];
      $updateSql = "update studenttb set fname='$fname', lname='$lname', email='$email', pass='$pass', mobno='$mob', address='$address', cityID=$city where sid=$sid";
      $result = mysqli_query($con, $updateSql);
      $count = mysqli_affected_rows($con);
      if($count > 0)
      {
        $_SESSION['scityid'] = $city;  
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
      unset($_SESSION['sid']);
      header("Location: ../studentLogin.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <style>
        .findNav{
            background-color: gray;
        }
        .edit, .home, .bookmark, .feedback, .request, .bookedtut{
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
        a
        {
          text-decoration: none;
          color: white;
        }
        a:hover{
          color: #9CC3D5FF;
        }
       
        .filtbtn {
        background-color: #04AA6D;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        cursor: pointer;
        width: 10%;
        }

        .filtbtn:hover {
        opacity: 0.8;
        }
        @media only screen and (max-width:770px) {
         .filtbtn{
           width: 50%;
         }
        }
        th, td{
          text-align: center;
        }
    </style>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script>
      $(document).ready(function(){
        $(".editNav").click(function(){
          $(".home").hide();
          $(".find").hide();
          $(".bookmark").hide();
          $(".edit").show();
          $(".feedback").hide();
          $(".request").hide();
          $(".bookedtut").hide();
          $(".homeNav").css("background-color", "rgb(33, 37, 41)");
          $(".findNav").css("background-color", "rgb(33, 37, 41)");
          $(".bookmarkNav").css("background-color", "rgb(33, 37, 41)");
          $(".feedbackNav").css("background-color", "rgb(33, 37, 41)");
          $(".requestNav").css("background-color", "rgb(33, 37, 41)");
          $(".editNav").css("background-color", "gray");
          $(".bookedtutNav").css("background-color", "rgb(33, 37, 41)");
        });
        $(".homeNav").click(function(){
          $(".home").show();
          $(".find").hide();
          $(".bookmark").hide();
          $(".edit").hide();
          $(".feedback").hide();
          $(".request").hide();
          $(".bookedtut").hide();
          $(".homeNav").css("background-color", "gray");
          $(".findNav").css("background-color", "rgb(33, 37, 41)");
          $(".bookmarkNav").css("background-color", "rgb(33, 37, 41)");
          $(".feedbackNav").css("background-color", "rgb(33, 37, 41)");
          $(".requestNav").css("background-color", "rgb(33, 37, 41)");
          $(".editNav").css("background-color", "rgb(33, 37, 41)");
          $(".bookedtutNav").css("background-color", "rgb(33, 37, 41)");
        });
        $(".findNav").click(function(){
          $(".home").hide();
          $(".find").show();
          $(".bookmark").hide();
          $(".edit").hide();
          $(".feedback").hide();
          $(".request").hide();
          $(".bookedtut").hide();
          $(".homeNav").css("background-color", "rgb(33, 37, 41)");
          $(".findNav").css("background-color", "gray");
          $(".bookmarkNav").css("background-color", "rgb(33, 37, 41)");
          $(".feedbackNav").css("background-color", "rgb(33, 37, 41)");
          $(".requestNav").css("background-color", "rgb(33, 37, 41)");
          $(".editNav").css("background-color", "rgb(33, 37, 41)");
          $(".bookedtutNav").css("background-color", "rgb(33, 37, 41)");
        });
        $(".feedbackNav").click(function(){
          $(".home").hide();
          $(".find").hide();
          $(".bookmark").hide();
          $(".edit").hide();
          $(".feedback").show();
          $(".request").hide();
          $(".bookedtut").hide();
          $(".homeNav").css("background-color", "rgb(33, 37, 41)");
          $(".findNav").css("background-color", "rgb(33, 37, 41)");
          $(".bookmarkNav").css("background-color", "rgb(33, 37, 41)");
          $(".feedbackNav").css("background-color", "gray");
          $(".requestNav").css("background-color", "rgb(33, 37, 41)");
          $(".editNav").css("background-color", "rgb(33, 37, 41)");
          $(".bookedtutNav").css("background-color", "rgb(33, 37, 41)");
        });
        $(".bookmarkNav").click(function(){
          $(".home").hide();
          $(".find").hide();
          $(".bookmark").show();
          $(".edit").hide();
          $(".feedback").hide();
          $(".request").hide();
          $(".bookedtut").hide();
          $(".homeNav").css("background-color", "rgb(33, 37, 41)");
          $(".findNav").css("background-color", "rgb(33, 37, 41)");
          $(".bookmarkNav").css("background-color", "gray");
          $(".requestNav").css("background-color", "rgb(33, 37, 41)");
          $(".feedbackNav").css("background-color", "rgb(33, 37, 41)");
          $(".editNav").css("background-color", "rgb(33, 37, 41)");
          $(".bookedtutNav").css("background-color", "rgb(33, 37, 41)");
        });
        $(".requestNav").click(function(){
          $(".home").hide();
          $(".find").hide();
          $(".bookmark").hide();
          $(".edit").hide();
          $(".feedback").hide();
          $(".request").show();
          $(".bookedtut").hide();
          $(".homeNav").css("background-color", "rgb(33, 37, 41)");
          $(".findNav").css("background-color", "rgb(33, 37, 41)");
          $(".bookmarkNav").css("background-color", "rgb(33, 37, 41)");
          $(".requestNav").css("background-color", "gray");
          $(".feedbackNav").css("background-color", "rgb(33, 37, 41)");
          $(".editNav").css("background-color", "rgb(33, 37, 41)");
          $(".bookedtutNav").css("background-color", "rgb(33, 37, 41)");
        });
        $(".bookedtutNav").click(function(){
          $(".home").hide();
          $(".find").hide();
          $(".bookmark").hide();
          $(".edit").hide();
          $(".feedback").hide();
          $(".request").hide();
          $(".bookedtut").show();
          $(".homeNav").css("background-color", "rgb(33, 37, 41)");
          $(".findNav").css("background-color", "rgb(33, 37, 41)");
          $(".bookmarkNav").css("background-color", "rgb(33, 37, 41)");
          $(".requestNav").css("background-color", "rgb(33, 37, 41)");
          $(".feedbackNav").css("background-color", "rgb(33, 37, 41)");
          $(".editNav").css("background-color", "rgb(33, 37, 41)");
          $(".bookedtutNav").css("background-color", "gray");
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
          <a class="nav-link active findNav" href="#">Find-Tutor</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active bookmarkNav" href="#">Bookmark-Tutor</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active feedbackNav" href="#">Feedback</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active requestNav" href="#">Requests</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active bookedtutNav" href="#">My-Tutors</a>
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
  <h2><b><u>Welcome <?php echo $_SESSION['sfName'], " ", $_SESSION['slName']; ?></u></b></h2>
  <div class="imgcontainer">
    <?php
      if($_SESSION['spic'] == '')
      {
        $img = '../images/defaultStud.jpg';
      }
      else
      {
        $img = $_SESSION['spic'];
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
  <h2>Hello <?php echo $_SESSION['sfName']; ?></h2>
  <h2>Email :- <?php echo $_SESSION['smail']; ?></h2>
  </center>
</div>
<div class="edit">
  <form method="post" class="register">
  <center>
      <div class="container frmClass">
          <h1>Edit Student Profile</h1>
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
        
        <label for="addr"><i class='material-icons' style='font-size:24px'>location_on</i></label>
        <input type="text" placeholder="Enter Address" name="addr"  value="<?php echo $address;?>" required><br>

        <label for="city"><i class='material-icons' style='font-size:24px'>location_city</i> <b>Select City :- </b></label>
        <select name="city">
          <?php
            $cityid = $_SESSION['scityid'];
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
<div class="find">
 <center>
   <h1>Filter Tutor</h1>
<form method="post" action="filterStudentHome.php">
 <label for="filtsub"><i class='fas fa-book' style='font-size:24px'></i> <b>Select Subject :- </b></label>
      <select name="filtsub">
        <?php
            $filtsub = $_POST['filtsub'];
            $subsql = "select * from subjectmaster where subID = $filtsub";
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
            $subsql = "select * from subjectmaster where subID <> $filtsub";
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
      </select><br/><br/>
      <label for="filtcity"><i class='fas fa-city' style='font-size:24px'></i> <b>Select City :- </b></label>
      <select name="filtcity">
        <?php
            $filtcity = $_POST['filtcity'];
            $citysql = "select * from citymaster where cityID = $filtcity";
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
            $citysql = "select * from citymaster where cityID <> $filtcity";
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
      </select><br/><br/>
      <label for="filtfee"><i class='fas fa-sort' style='font-size:24px'></i> <b>Choose Fee Order :- </b></label>
      <select name="filtfee">
        <!-- <option value="asc">Low to High</option>
        <option value="desc">High to Low</option> -->
        <?php
          if($_POST['filtfee'] == "asc")
          {
            ?>
              <option value="asc">Low to High</option>
              <option value="desc">High to Low</option>
            <?php
          }
          else
          {
            ?>
              <option value="desc">High to Low</option>
              <option value="asc">Low to High</option>
            <?php
          }
        ?>
      </select><br>
      <input name="filter" class="filtbtn" type="submit" value="Filter"/><br/>
  </form>
   <div class="container">
      <?php
        $filtcity = $_POST['filtcity'];
        $filtsub = $_POST['filtsub'];
        $filtfee = $_POST['filtfee'];
        $sql = "select t.tid, t.fname, t.lname, t.pic, s.subName, t.email, t.mobno, t.qual, t.address, c.cityName, avg(r.rating), t.fee, st.status from tutortb t, ratingtb r, statusmaster st, citymaster c, subjectmaster s where t.subID = s.subID and t.cityID = c.cityID and t.statusID = st.statusID and r.tid = t.tid and t.cityID = $filtcity and t.subID = $filtsub group by tid order by t.fee $filtfee";
        $res = mysqli_query($con, $sql);
        while($tut = mysqli_fetch_array($res))
        {
          ?>
            <div class="table-responsive">
              <table border=4 class='table'>
                <tr>
                  <th rowspan="11">
                    <img src="<?php echo $tut[3];?>" alt="" height="380" width="260">
                  </th>
                </tr>
                <tr>
                  <th>Name :- </th>
                  <td><?php echo $tut[1], " " ,$tut[2]; ?></td>
                </tr>
                <tr>
                  <th>Subjects :- </th>
                  <td><?php echo $tut[4]; ?></td>
                </tr>
                <tr>
                  <th>Email :- </th>
                  <td><?php echo $tut[5]; ?></td>
                </tr>
                <tr>
                  <th>Mobile No :- </th>
                  <td><?php echo $tut[6]; ?></td>
                </tr>
                <tr>
                  <th>Qualification :- </th>
                  <td><?php echo $tut[7]; ?></td>
                </tr>
                <tr>
                  <th>Address :- </th>
                  <td><?php echo $tut[8]; ?></td>
                </tr>
                <tr>
                  <th>City :- </th>
                  <td><?php echo $tut[9]; ?></td>
                </tr>
                <tr>
                  <th>Rating :- </th>
                  <td><?php if($tut[10] == null){ echo "Not Rated yet...";}else{ echo $tut[10]; } ?></td>
                </tr>
                <tr>
                  <th>Fee :- </th>
                  <td><?php echo "₹ ", $tut[11]; ?></td>
                </tr>
                <tr>
                  <th>Status :- </th>
                  <td><?php echo $tut[12]; ?></td>
                </tr>
                <tr>
                <td><button class="btn btn-danger"><a href="bookmarkinsert.php?tid=<?php echo $tut[0]; ?>">Bookmark</a></button></td>
                <td><button class="btn btn-primary"><a href="requesttutor.php?tid=<?php echo $tut[0]; ?>&sid=<?php echo $_SESSION['sid']; ?>&fee=<?php echo $tut[11]; ?>">Request-Tutor</a></button></td>
                </tr>
              </table>
            </div>
          <?php
        }
      ?>
   </div>
 </center>
</div>
<div class="bookmark">
<center>
   <div class="container">
      <?php
        $booksql = "select t.tid, t.fname, t.lname, t.pic, s.subName, t.email, t.mobno, t.qual, t.address, c.cityName, avg(r.rating), t.fee, st.status, b.bookmarkID from tutortb t, ratingtb r, statusmaster st, citymaster c, subjectmaster s, bookmarktb b, studenttb std where t.subID = s.subID and t.cityID = c.cityID and t.statusID = st.statusID and r.tid = t.tid and b.tid = t.tid and std.sid = b.sid and std.sid = $sid group by tid";
        $bookres = mysqli_query($con, $booksql);
        $bookcount = mysqli_affected_rows($con);
        if($bookcount > 0)
        {
          echo "<html><center><h1>All Your Bookmarks</h1></center></html>";
          while($booktut = mysqli_fetch_array($bookres))
          {
            ?>
              <div class="table-responsive">
                <table border=4 class='table'>
                  <tr>
                    <th rowspan="11">
                      <img src="<?php echo $booktut[3];?>" alt="" height="380" width="260">
                    </th>
                  </tr>
                  <tr>
                    <th>Name :- </th>
                    <td><?php echo $booktut[1], " " ,$booktut[2]; ?></td>
                  </tr>
                  <tr>
                    <th>Subjects :- </th>
                    <td><?php echo $booktut[4]; ?></td>
                  </tr>
                  <tr>
                    <th>Email :- </th>
                    <td><?php echo $booktut[5]; ?></td>
                  </tr>
                  <tr>
                    <th>Mobile No :- </th>
                    <td><?php echo $booktut[6]; ?></td>
                  </tr>
                  <tr>
                    <th>Qualification :- </th>
                    <td><?php echo $booktut[7]; ?></td>
                  </tr>
                  <tr>
                    <th>Address :- </th>
                    <td><?php echo $booktut[8]; ?></td>
                  </tr>
                  <tr>
                    <th>City :- </th>
                    <td><?php echo $booktut[9]; ?></td>
                  </tr>
                  <tr>
                    <th>Rating :- </th>
                    <td><?php if($booktut[10] == null){ echo "Not Rated yet...";}else{ echo $booktut[10]; } ?></td>
                  </tr>
                  <tr>
                    <th>Fee :- </th>
                    <td><?php echo "₹ ", $booktut[11]; ?></td>
                  </tr>
                  <tr>
                    <th>Status :- </th>
                    <td><?php echo $booktut[12]; ?></td>
                  </tr>
                    <tr>
                      <td><button class="btn btn-danger"><a href="bookmarkremove.php?bid=<?php echo $booktut[13]; ?>">Remove-Bookmark</a></button></td>
                      <td><button class="btn btn-primary"><a href="requesttutor.php?tid=<?php echo $booktut[0]; ?>&sid=<?php echo $_SESSION['sid']; ?>&fee=<?php echo $booktut[11]; ?>">Request-Tutor</a></button></td>
                    </tr>
                  </table>
                </div>
              <?php
            }
          }
          else
          {
            echo "<html><br/><br/><center><h1>No Bookmarks Available</h1></center></html>";
          }
      ?>
   </div>
 </center>
</div>
<div class="feedback">
<center>
   <div class="container table-responsive">
    <table class="table">
      <thead class="table-dark">
        <tr>
          <th>Name</th>
          <th>Email</th>
          <th>Mobile-Number</th>
          <th>Subject</th>
          <th>Give-Rating</th>
          <th>Submit</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $feedsql = "select t.fname,t.lname,t.email,t.mobno,s.subName,t.tid from tutortb t, subjectmaster s, booktb b, studenttb st where b.sid=st.sid and st.sid=$sid and b.tid=t.tid and t.subID=s.subID";
          $feedres = mysqli_query($con, $feedsql);
          $feedcount = mysqli_affected_rows($con);
          if($feedcount > 0)
          {
            echo "<html><center><h1>Give Feedback</h1></center></html>";
            while($feedrow = mysqli_fetch_array($feedres))
            {
              ?>
              <form action="givefeedback.php?sid=<?php echo $sid; ?>&tid=<?php echo $feedrow[5]; ?>" method="post">
                <tr>
                  <td><?php echo $feedrow[0], " ", $feedrow[1];?></td>
                  <td><?php echo $feedrow[2]; ?></td>
                  <td><?php echo $feedrow[3]; ?></td>
                  <td><?php echo $feedrow[4]; ?></td>
                  <td>
                    <select name="rating">
                      <option value="1">1 - Poor</option>
                      <option value="2">2 - Below-Average</option>
                      <option value="3">3 - Average</option>
                      <option value="4">4 - Above-Average</option>
                      <option value="5">5 - Excellent</option>
                    </select>
                  </td>
                  <td>
                    <button type="submit" class="btn btn-secondary">Submit-Rating</button>
                  </td>
                </tr>
              </form>
              <?php
            }
          }
          else
          {
            echo "<html><center><h1>No Tutor Booked</h1></center></html>";
          }
        ?>
      </tbody>
    </table>
   </div>
 </center>
</div>
<div class="request">
<center>
   <div class="container">
      <?php
        $reqsql = "select t.fName,t.lName,t.pic,t.email,s.subName,t.mobno,t.fee,t.qual,t.address,c.cityName,avg(r.rating),rs.reqStatus,t.tid from tutortb t, subjectmaster s, citymaster c, ratingtb r, requeststatus rs, requesttb rq, studenttb st where rq.sid=$sid and r.tid = t.tid and st.sid = $sid and st.sid = rq.sid and t.tid=rq.tid and rq.reqID=rs.reqID and t.cityID=c.cityID and t.subID=s.subID group by t.tid";
        $reqres = mysqli_query($con, $reqsql);
        $reqcount = mysqli_affected_rows($con);
        if($reqcount > 0)
        {
          echo "<html><center><h1>All Your Requests</h1></center></html>";
          while($reqtut = mysqli_fetch_array($reqres))
          {
            ?>
              <div class="table-responsive">
                <table border=4 class='table'>
                  <tr>
                    <th rowspan="11">
                      <img src="<?php echo $reqtut[2];?>" alt="" height="380" width="260">
                    </th>
                  </tr>
                  <tr>
                    <th>Name :- </th>
                    <td><?php echo $reqtut[0], " " ,$reqtut[1]; ?></td>
                  </tr>
                  <tr>
                    <th>Subject :- </th>
                    <td><?php echo $reqtut[4]; ?></td>
                  </tr>
                  <tr>
                    <th>Email :- </th>
                    <td><?php echo $reqtut[3]; ?></td>
                  </tr>
                  <tr>
                    <th>Mobile No :- </th>
                    <td><?php echo $reqtut[5]; ?></td>
                  </tr>
                  <tr>
                    <th>Qualification :- </th>
                    <td><?php echo $reqtut[7]; ?></td>
                  </tr>
                  <tr>
                    <th>Address :- </th>
                    <td><?php echo $reqtut[8]; ?></td>
                  </tr>
                  <tr>
                    <th>City :- </th>
                    <td><?php echo $reqtut[9]; ?></td>
                  </tr>
                  <tr>
                    <th>Rating :- </th>
                    <td><?php if($reqtut[10] == null){ echo "Not Rated yet...";}else{ echo $reqtut[10]; } ?></td>
                  </tr>
                  <tr>
                    <th>Fee :- </th>
                    <td><?php echo "₹ ", $reqtut[6]; ?></td>
                  </tr>
                  <tr>
                    <th>Request-Status :- </th>
                    <td><?php echo $reqtut[11]; ?></td>
                  </tr>
                    <tr>
                      <td><button class="btn btn-warning"><a href="https://api.whatsapp.com/send?phone=91<?php echo $reqtut[5];  ?>">Send-Message</a></button></td>
                      <?php
                        if($reqtut[11] == "Pending")
                        {
                          ?>
                            <td><button class="btn btn-danger"><a href="cancelrequest.php?tid=<?php echo $reqtut[12]; ?>&sid=<?php echo $_SESSION['sid']; ?>">Cancel-Request</a></button></td>
                          <?php
                        }
                        else
                        {
                          ?>
                            <td><button class="btn btn-danger"><a href="booktutor.php?tid=<?php echo $reqtut[12]; ?>&sid=<?php echo $_SESSION['sid']; ?>">Pay & Book</a></button></td>
                          <?php
                        }
                      ?>
                    </tr>
                  </table>
                </div>
              <?php
            }
          }
          else
          {
            echo "<html><br/><br/><center><h1>No Requests Sent</h1></center></html>";
          }
      ?>
   </div>
 </center>
</div>
<div class="bookedtut">
<center>
   <div class="container">
      <?php
        $tutsql = "select t.fname,t.lname,t.pic,t.email,t.address, t.mobno,c.cityName,s.subName, t.qual, t.tid from tutortb t, citymaster c, subjectmaster s, booktb b, studenttb st where b.sid=st.sid and st.sid=$sid and b.tid=t.tid and t.cityID=c.cityID and t.subID=s.subID";
        $tutres = mysqli_query($con, $tutsql);
        $tutcount = mysqli_affected_rows($con);
        if($tutcount > 0)
        {
          echo "<html><center><h1>Your Tutors</h1></center></html>";
          while($tutdata = mysqli_fetch_array($tutres))
          {
            ?>
              <div class="table-responsive">
                <table border=4 class='table'>
                  <tr>
                    <th rowspan="11">
                      <img src="<?php echo $tutdata[2];?>" alt="" height="380" width="260">
                    </th>
                  </tr>
                  <tr>
                    <th>Name :- </th>
                    <td><?php echo $tutdata[0], " " ,$tutdata[1]; ?></td>
                  </tr>
                  <tr>
                    <th>Subject :- </th>
                    <td><?php echo $tutdata[7]; ?></td>
                  </tr>
                  <tr>
                    <th>Email :- </th>
                    <td><?php echo $tutdata[3]; ?></td>
                  </tr>
                  <tr>
                    <th>Mobile No :- </th>
                    <td><?php echo $tutdata[5]; ?></td>
                  </tr>
                  <tr>
                    <th>Qualification :- </th>
                    <td><?php echo $tutdata[8]; ?></td>
                  </tr>
                  <tr>
                    <th>Address :- </th>
                    <td><?php echo $tutdata[4]; ?></td>
                  </tr>
                  <tr>
                    <th>City :- </th>
                    <td><?php echo $tutdata[6]; ?></td>
                  </tr>
                    <tr>
                      <td><button class="btn btn-primary"><a href="https://api.whatsapp.com/send?phone=91<?php echo $tutdata[5];  ?>">Send-Message</a></button></td>
                      <td><button class="btn btn-warning"><a href="cancelbooking.php?sid=<?php echo $sid ?>&tid=<?php echo $tutdata[9]; ?>">Cancel-Booking</a></button></td> 
                    </tr>
                  </table>
                </div>
              <?php
            }
          }
          else
          {
            echo "<html><br/><br/><center><h1>No Tutor Booked</h1></center></html>";
          }
      ?>
   </div>
 </center>
</div>
</body>
</html>
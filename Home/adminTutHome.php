<?php
    session_start();
    include('../dbCon.php');

    $aid = $_SESSION['aid'];
    $uname = $_SESSION['adminName'];
    $mail = $_SESSION['adminMail'];

    $sql = "select pass from admintb where aid = '$aid'";
    $res = mysqli_query($con, $sql);
    $pass = mysqli_fetch_array($res)[0];

    if(isset($_POST['edit']))
    {
      $uname = $_POST['uname'];
      $mail = $_POST['email'];
      $pass = $_POST['psw'];
      $saveQry = "update admintb set uname = '$uname', email = '$mail', pass = '$pass'";
      $saveRes = mysqli_query($con, $saveQry);
      $count = mysqli_affected_rows($con);
      if($count > 0)
      {
        ?>
          <script>
            alert("Record Updated Successfully...");
          </script>
        <?php
        $_SESSION['adminName'] = $uname;
        $_SESSION['adminMail'] = $mail;
      }
      else
      {
        ?>
          <script>
            alert("Error in Updating the record...");
          </script>
        <?php
      }
    }
    if(isset($_POST['logout']))
    {
      unset($_SESSION['aid']);
      header("Location: ../adminLogin.php");
    }
    $studQry = "select s.fname, s.lname, s.email, s.mobno, s.address, m.cityName, s.regDate, s.loginDate, sm.status, s.sid from studenttb s, citymaster m, statusmaster sm where s.statusID = sm.statusID and s.cityID = m.cityID";
    $studRes = mysqli_query($con, $studQry);

    $tutQry = "select t.tid, t.fname, t.lname, s.subName, t.email, t.mobno, t.qual, t.address, c.cityName, t.fee, t.regDate, t.loginDate, st.status from tutortb t, statusmaster st, citymaster c, subjectmaster s where t.subID = s.subID and t.cityID = c.cityID and t.statusID = st.statusID";
    $tutRes = mysqli_query($con, $tutQry);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <script>
      $(document).ready(function(){
        $(".editNav").click(function(){
          $(".home").hide();
          $(".tut").hide();
          $(".stud").hide();
          $(".edit").show();
          $(".homeNav").css("background-color", "rgb(33, 37, 41)");
          $(".studNav").css("background-color", "rgb(33, 37, 41)");
          $(".tutNav").css("background-color", "rgb(33, 37, 41)");
          $(".editNav").css("background-color", "gray");
        });
        $(".homeNav").click(function(){
          $(".home").show();
          $(".edit").hide();
          $(".tut").hide();
          $(".stud").hide();
          $(".homeNav").css("background-color", "gray");
          $(".studNav").css("background-color", "rgb(33, 37, 41)");
          $(".tutNav").css("background-color", "rgb(33, 37, 41)");
          $(".editNav").css("background-color", "rgb(33, 37, 41)");
        });
        $(".studNav").click(function(){
          $(".home").hide();
          $(".edit").hide();
          $(".tut").hide();
          $(".stud").show();
          $(".studNav").css("background-color", "gray");
          $(".tutNav").css("background-color", "rgb(33, 37, 41)");
          $(".homeNav").css("background-color", "rgb(33, 37, 41)");
          $(".editNav").css("background-color", "rgb(33, 37, 41)");
        });
        $(".tutNav").click(function(){
          $(".home").hide();
          $(".edit").hide();
          $(".tut").show();
          $(".stud").hide();
          $(".tutNav").css("background-color", "gray");
          $(".studNav").css("background-color", "rgb(33, 37, 41)");
          $(".homeNav").css("background-color", "rgb(33, 37, 41)");
          $(".editNav").css("background-color", "rgb(33, 37, 41)");
        });
      });
    </script>
    <style>
      .tutNav{
        background-color: gray;
      }
      .edit, .stud, .home{
        display: none;
      }
      img.avatar {
        width: 30%;
        height: 30%;
        border-radius: 50%;
      }
      .imgcontainer {
        text-align: center;
        margin: 80px 0 12px 0;
      }
      body{
        background: linear-gradient(to bottom, #ffffff 0%, #99ccff 100%);
        background-repeat: no-repeat;
        background-attachment: fixed;
      }
      .frmClass{
          background-color: rgb(120, 172, 255);
          width: 700px;
          border-radius: 25px;
          margin-top: 130px;
      }
      input[type=text], input[type=password], input[type=email] {
        width: 60%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        box-sizing: border-box;
      }

      .btnChange {
        background-color: #04AA6D;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        cursor: pointer;
        width: 30%;
      }

      .btnChange:hover {
        opacity: 0.8;
      }
      .studtb{
        margin-top: 20px;
      }
      .tuttb{
        margin-top: 20px;
      }
      th, td{
        text-align: center;
        line-height: 30px;
        border: 1px solid black;
      }
      .dlt{
        text-decoration: none;
        font-size: 30px;
      }
      .container-fluid{
        width: 100%;
      }
      .table-responsive{
        padding-left: 50px;
        padding-right: 50px;
      }
    </style>
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
          <a class="nav-link active studNav" href="#">Student-Details</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active tutNav" href="#">Tutor-Details</a>
        </li>
      </ul>
      <form class="d-flex" method="post">
        <button class="btn btn-outline-success" name="logout" type="submit"><i class='fas fa-sign-out-alt' style='font-size'></i>Logout</button>
      </form>
    </div>
  </div>
</nav>
<div class="home">
    <center><br/>
    <h2><b><u>Welcome Admin</u></b></h2>
    <div class="imgcontainer">
      <img src="../images/admin.png" alt="Avatar" class="avatar">
    </div><br/>
    <h2>Hello <?php echo $_SESSION['adminName']; ?></h2>
    <h2>Email :- <?php echo $_SESSION['adminMail']; ?></h2>
    </center>
</div>
<div class="edit">
  <center>
    <div class="container">
      <form method="post" class="form-inline">
        <div class="container frmClass form-group">
          <h2>Edit-Profile</h2>
          <label for="uname"><i class='fas fa-address-card' style='font-size:24px'></i></label>
          <input type="text" placeholder="Enter Username" name="uname" value="<?php echo $uname; ?>" required><br>

          <label for="uname"><i class='fas fa-mail-bulk' style='font-size:24px'></i></label>
          <input type="email" placeholder="Enter Username" name="email" value="<?php echo $mail; ?>" required><br>

          <label for="psw"><i class='fas fa-lock' style='font-size:24px'></i></label>
          <input type="password" placeholder="Enter Password" name="psw" value="<?php echo $pass; ?>" required><br>
              
          <input name="edit" class="btnChange" type="submit" value="Save"/>
        </div>
      </form>
    </div>
  </center>
</div>
<div class="stud">
    <center>
      <div class="table-responsive container">
        <table class="table studtb">
          <thead class="table-dark">
            <tr>
              <th>First Name</th>
              <th>Last Name</th>
              <th>Email</th>
              <th>Mobile No</th>
              <th>Address</th>
              <th>City</th>
              <th>Registration-Date</th>
              <th>Login-Date</th>
              <th>Status</th>
              <th>Delete</th>
            </tr>
          </thead>
          <tbody>
            <?php
              while($studArr = mysqli_fetch_Array($studRes))
              {
                ?>
                  <tr>
                    <td><?php echo $studArr[0]; ?></td>
                    <td><?php echo $studArr[1]; ?></td>
                    <td><?php echo $studArr[2]; ?></td>
                    <td><?php echo $studArr[3]; ?></td>
                    <td><?php echo $studArr[4]; ?></td>
                    <td><?php echo $studArr[5]; ?></td>
                    <td><?php echo $studArr[6]; ?></td>
                    <td><?php echo $studArr[7]; ?></td>
                    <td><?php echo $studArr[8]; ?></td>
                    <td><a class="dlt" href="studDelAdmin.php?sid=<?php echo $studArr[9]; ?>">🏴‍☠️</a></td>
                  </tr>
                <?php
              }
            ?>
          </tbody>
        </table>
      </div>
    </center>
</div>
<div class="tut">
<center>
      <div class="table-responsive">
        <table class="table tuttb">
          <thead class="table-dark">
            <tr>
              <th>First Name</th>
              <th>Last Name</th>
              <th>Subject</th>
              <th>Email</th>
              <th>Mobile No</th>
              <th>Qualification</th>
              <th>Address</th>
              <th>City</th>
              <th>Fee</th>
              <th>Registration-Date</th>
              <th>Login-Date</th>
              <th>Status</th>
              <th>Delete</th>
            </tr>
          </thead>
          <tbody>
          <?php
              while($tutArr = mysqli_fetch_Array($tutRes))
              {
                ?>
                  <tr>
                    <td><?php echo $tutArr[1]; ?></td>
                    <td><?php echo $tutArr[2]; ?></td>
                    <td><?php echo $tutArr[3]; ?></td>
                    <td><?php echo $tutArr[4]; ?></td>
                    <td><?php echo $tutArr[5]; ?></td>
                    <td><?php echo $tutArr[6]; ?></td>
                    <td><?php echo $tutArr[7]; ?></td>
                    <td><?php echo $tutArr[8]; ?></td>
                    <td><?php echo $tutArr[9]; ?></td>
                    <td><?php echo $tutArr[10]; ?></td>
                    <td><?php echo $tutArr[11]; ?></td>
                    <td><?php echo $tutArr[12]; ?></td>
                    <td><a class="dlt" href="tutDelAdmin.php?tid=<?php echo $tutArr[0]; ?>">🏴‍☠️</a></td>
                  </tr>
                <?php
              }
            ?>
          </tbody>
        </table>
      </div>
    </center>
</div>
</body>
</html>
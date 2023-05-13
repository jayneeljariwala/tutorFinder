<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width= , initial-scale=1.0">
    <title>Find Your Tutor</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <style>
        body{
            background-image: url('images/2.jpg');
            background-size: cover;
            background-repeat: no-repeat;
        }
        img{
            border: 5px solid black;
            opacity: 0.6;
        }
        h1{
            border: 3px solid black;
            width: 400px;
            text-align:center;
            font-size: 30px;
            background-color: lightgray;
            cursor: pointer;
            color: rgb(0, 0, 140);
            opacity: 0.8;
            height: 70px;
            line-height: 70px;
        }
        h1:hover{
            background-color:gray;
        }
        .heading{
            background-color: lightgreen;
            color:red;
            width: 500px;
            height: 80px;
        }
        .d1{
            margin-top: 170px;
        }
        .d2{
            margin-left: 0px;
        }
        a:hover{
            text-decoration: none;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-4">
            <img src="images/logo.jfif" class="logo">
        </div>
        <center>
        <div class="col">
            <h1 class="heading">Find a Perfect Tutor</h1>
        </div>
        </center>
        <div class="col"></div>
    </div>
</div>
<center>
<div class="d1">
    <div class="container-fluid">
        <div class="d2">
            <div class="row">
                <div class="col box">
                    <h1><a href="studentLogin.php">Login/Register As Student</a></h1>
                </div>
                <div class="col box">
                    <h1><a href="tutorLogin.php">Login/Register As Tutor</a></h1>
                </div>
            </div>
        </div>
    </div>
</div>
</center>
</body>
</html>
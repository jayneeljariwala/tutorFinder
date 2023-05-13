<?php
    include("../dbCon.php");
    session_start();
    $tid = $_GET['tid'];
    $sid = $_GET['sid'];
    $rating = $_POST['rating'];

    $sql = "update ratingtb set rating = $rating where tid = $tid and sid = $sid";
    $res = mysqli_query($con, $sql);
    $count = mysqli_affected_rows($con);

    if($count > 0)
    {
        ?>
            <script>
                alert("Rating Submitted...");
                window.location.replace("studentHome.php");
            </script>
        <?php
    }
    else
    {
        ?>
            <script>
                alert("Something went wrong...");
                window.location.replace("studentHome.php");
            </script>
        <?php
    }
?>
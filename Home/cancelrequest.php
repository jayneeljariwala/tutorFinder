<?php
    include("../dbCon.php");
    $tid = $_GET['tid'];
    $sid = $_GET['sid'];

    $sql = "delete from requesttb where tid = $tid and sid = $sid";
    $res = mysqli_query($con, $sql);
    $count = mysqli_affected_rows($con);
    if($count > 0)
    {
        ?>
            <script>
                alert("Request Cancelled...");
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
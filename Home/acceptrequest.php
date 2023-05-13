<?php
    include('../dbCon.php');
    $sid = $_GET['sid'];
    $tid = $_GET['tid'];

    $sql = "update requesttb set reqID = 2 where sid = $sid and tid = $tid";
    $res = mysqli_query($con, $sql);
    $count = mysqli_affected_rows($con);
    if($count > 0)
    {
        ?>
            <script>
                window.location.replace('tutorHome.php');
            </script>
        <?php
    }
    else
    {
        ?>
            <script>
                alert("Somthing went wrong...");
                window.location.replace('tutorHome.php');
            </script>
        <?php
    }
?>
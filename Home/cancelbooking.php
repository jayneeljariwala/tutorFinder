<?php
    include('../dbCon.php');
    $sid = $_GET['sid'];
    $tid = $_GET['tid'];

    $sql = "delete from booktb where sid=$sid and tid=$tid";
    $res = mysqli_query($con, $sql);
    $count = mysqli_affected_rows($con);

    if($count > 0)
    {
        ?>
            <script>
                alert("Booking Cancelled...");
                window.location.replace('studentHome.php');
            </script>
        <?php
    }
    else
    {
        ?>
            <script>
                alert("Something went wrong...");
                window.location.replace('studentHome.php');
            </script>
        <?php
    }
?>
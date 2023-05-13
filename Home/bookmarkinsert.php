<?php
    include("../dbcon.php");
    session_start();
    $tid = $_GET['tid'];
    $sid = $_SESSION['sid'];
    $checksql = "select * from bookmarktb where tid = $tid and sid = $sid";
    $checkres = mysqli_query($con, $checksql);
    $checkcount = mysqli_affected_rows($con);
    if($checkcount > 0)
    {
        ?>
        <script>
            alert("Tutor Already Bookmarked...");
            window.location.replace("studentHome.php");
        </script>
        <?php
    }
    else
    {
        $sql = "insert into bookmarktb(tid, sid) values($tid, $sid)";
        $res = mysqli_query($con, $sql);
        $count = mysqli_affected_rows($con);
        if($count > 0)
        {
            ?>
            <script>
                alert("Tutor bookmarked...");
                window.location.replace("studentHome.php");
            </script>
            <?php
        }
        else
        {
            ?>
            <script>
                alert("Error occured during bookmarking...");
                window.location.replace("studentHome.php");
            </script>
            <?php
        }
    }
?>
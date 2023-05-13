<?php
    include("../dbCon.php");
    $tid = $_GET['tid'];
    $sid = $_GET['sid'];
    $bookdate = date('Y/m/d H:i:s');

    $checksql = "select * from booktb where sid = $sid and tid = $tid";
    $checkres = mysqli_query($con, $checksql);
    $checkcount = mysqli_affected_rows($con);
    if($checkcount > 0)
    {
        ?>
            <script>
                alert("Tutor already Booked...");
                window.location.replace("studentHome.php");
            </script>
        <?php
    }
    else
    {
        $sql = "insert into booktb(sid, tid, bookDate) values($sid, $tid, '$bookdate')";
        $res = mysqli_query($con, $sql);
        $count = mysqli_affected_rows($con);

        if($count > 0)
        {
            $delreq = "delete from requesttb where tid = $tid and sid = $sid";
            $delres = mysqli_query($con, $delreq);
            ?>
                <script>
                    alert("Tutor Booked...");
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
    }
?>
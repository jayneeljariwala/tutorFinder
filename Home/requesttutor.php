<?php
    include("../dbCon.php");
    $tid = $_GET['tid'];
    $sid = $_GET['sid'];
    $fee = $_GET['fee'];
    $reqdate = date('Y/m/d H:i:s');

    $fetchsql = "select sid, tid from requesttb where sid = $sid and tid = $tid";
    $fetchres = mysqli_query($con, $fetchsql);
    $fetchcount = mysqli_affected_rows($con);
    
    if($fetchcount > 0)
    {
        ?>
            <script>
                alert("Already Requested...");
                window.location.replace("studentHome.php");
            </script>
        <?php
    }
    else
    {
        $sql = "insert into requesttb(sid, tid, reqID, fee, reqDate) values($sid, $tid, 1, $fee, '$reqdate')";
        $res = mysqli_query($con, $sql);
        $count = mysqli_affected_rows($con);
        if($count > 0)
        {
            ?>
                <script>
                    alert("Request sent...");
                    window.location.replace("studentHome.php");
                </script>
            <?php
        }
        else
        {
            ?>
                <script>
                    alert("Somthing went wrong...");
                    window.location.replace("studentHome.php");
                </script>
            <?php
        }
    }
?>
<?php
    include('../dbCon.php');
    $sid = $_GET['sid'];
    $sql = "delete from studenttb where sid = '$sid'";
    $res = mysqli_query($con, $sql);
    $count = mysqli_affected_rows($con);
    if($count > 0)
    {
        header('Location: adminStudHome.php');
    }
    else
    {
        ?>
            <script>
                alert("Error in deleting the record...");
            </script>
        <?php
        header("Location: adminHome.php");
    }
?>
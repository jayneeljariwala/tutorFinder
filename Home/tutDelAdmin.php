<?php
    include('../dbCon.php');
    $tid = $_GET['tid'];
    $sql = "delete from tutortb where tid = '$tid'";
    $res = mysqli_query($con, $sql);
    $count = mysqli_affected_rows($con);
    if($count > 0)
    {
        header('Location: adminTutHome.php');
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
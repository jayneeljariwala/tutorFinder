<?php
    include("../dbcon.php");
    $bid = $_GET['bid'];
    $sql = "delete from bookmarktb where bookmarkID = $bid";
    $res = mysqli_query($con, $sql);
    $count = mysqli_affected_rows($con);
    if($count > 0)
    {
        ?>
            <script>
                alert("Removed from Bookmark...");
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
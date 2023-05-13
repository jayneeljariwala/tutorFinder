<?php
    include('dbCon.php');
    $sql = "select * from requesttb";
    $res = mysqli_query($con, $sql);
    while($row = mysqli_fetch_array($res))
    {
        $reqDateTime = explode(" ", $row[5]);
        $reqDate = $reqDateTime[0];
        $date1 = new DateTime();
        $date2 = new DateTime($reqDate);
        $interval = $date1->diff($date2);
        $days = $interval->d." days ";

        if($days >= 3)
        {
            $delSql = "delete from requesttb where rid = $row[0] and reqID = 1";
            $delRes = mysqli_query($con, $delSql);
        }
    }
?>
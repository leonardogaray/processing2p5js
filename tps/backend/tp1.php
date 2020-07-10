<?php 

try {
    require 'database.php';

    $js = "tp1.js";

    if($userId != ""){
        $where = " u.id = " . $userId;
    }else if($groupId != ""){
        if($groupId != "T")
            $where = " ass.id = " . $groupId;
    }else {
        $where = " ass.id IN (8,9,10,11) ";
    }
    $sql = "SELECT ass.id gid, u.id uid, u.lastname, u.firstname, assot.onlinetext 
    FROM moodle.mdl_assignsubmission_onlinetext assot
    inner join moodle.mdl_assign_submission asss on asss.id = assot.submission
    inner join moodle.mdl_assign ass on ass.id = assot.assignment
    inner join moodle.mdl_user u on u.id = asss.userid
    where ".$where." 
    order by ass.id, u.lastname, u.firstname";

    $stmt = $conn->prepare($sql);
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
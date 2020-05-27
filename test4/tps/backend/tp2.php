<?php 

try {
    require 'database.php';
    require 'readFiles.php';

    $where = " ass.id IN (16) "; //Id from TP
    
    if($userId != ""){
        $where = " AND u.id = " . $userId;
    }else if($groupId != ""){
        if($groupId != "T")
            $where = " AND g.id = " . $groupId;
    }

    $sql = "SELECT DISTINCT ass.id gid, u.id uid, u.lastname, u.firstname, assot.onlinetext 
    FROM moodle.mdl_assignsubmission_onlinetext assot
    INNER JOIN moodle.mdl_assign_submission asss ON asss.id = assot.submission
    INNER JOIN moodle.mdl_assign ass ON ass.id = assot.assignment
    INNER JOIN moodle.mdl_user u ON u.id = asss.userid
    INNER JOIN moodle.mdl_groups_members gm ON gm.userid = u.id
    INNER JOIN moodle.mdl_groups g ON g.id = gm.groupid 
    WHERE ".$where." 
    ORDER BY ass.id, u.lastname, u.firstname";

    $stmt = $conn->prepare($sql);
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    
    foreach($result as $index => $row){
        //$github = "https://github.com/leonardogaray/tecnomultimedia/tree/tp2";
        $url = preg_match_all("#\bhttps?://[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/))#", $row["onlinetext"], $matches);
        $github = strtolower($matches[0][0]);
        $repo = preg_replace("/https\:\/\/github.com\/(\w+)\/(\w+)\/tree\/tp2/", '$1', $github);
        $project = preg_replace("/https\:\/\/github.com\/(\w+)\/(\w+)\/tree\/tp2/", '$2', $github);
        
        $result[$index]["github"] = $github;
        $result[$index]["repo"] = $repo;
        $result[$index]["project"] = $project;
        $result[$index]["processed_onlinetext"] = readFiles($repo, $project);
    }

}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
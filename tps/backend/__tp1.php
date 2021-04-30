<?php 

function stripAccents($str) {
    return strtr(utf8_decode($str), utf8_decode('àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ'), 'aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY');
}

try {
    require dirname(__FILE__) . '/__database.php';
    require dirname(__FILE__) . '/__readFiles.php';
    require dirname(__FILE__) . '/../conf/const.php';

    $js = $tp_global . ".js";

    $where = " ass.id IN (60) "; //Id from TP - moodle.mdl_assign
    
    if($userId != ""){
        $where .= " AND u.id = " . $userId;
    }else if($groupId != ""){
        if($groupId != "T")
            $where .= " AND g.id = " . $groupId;
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
        $url = preg_match_all("#\bhttps?://[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/))#", $row["onlinetext"], $matches);
        $github = strtolower($matches[0][0]);
        $repo = preg_replace("/https\:\/\/github.com\/([a-zA-Z0-9_-]+)\/(\w+)\/tree\/".$tp_global."/", '$1', $github);
        $project = preg_replace("/https\:\/\/github.com\/([a-zA-Z0-9_-]+)\/(\w+)\/tree\/".$tp_global."/", '$2', $github);
        
        $result[$index]["github"] = $github;
        $result[$index]["names"] = strtolower(str_replace(' ','',preg_replace('/[^A-Za-z0-9.]+/','',stripAccents($result[$index]["lastname"]) . stripAccents($result[$index]["firstname"]))));
        $result[$index]["repo"] = $repo;
        $result[$index]["project"] = $project;
        $result[$index]["processed_onlinetext"] = readFiles($result[$index]["names"], $project);
        $result[$index]["valid_url"] = preg_match("/https\:\/\/github.com\/([a-zA-Z0-9_-]+)\/tecnomultimedia\/tree\/".$tp_global."$/",$github);
        $result[$index]["main_file_exist"] = mainFileExist($result[$index]["names"], $project);
    }

}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
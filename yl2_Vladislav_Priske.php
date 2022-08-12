<?php 
    $serverHost = "localhost:3306";
    $serverUsername = "root";
    $serverPassword = "";
    $dbName = "raintree";
  
    function getPatients($serverHost, $serverUsername, $serverPassword, $dbName){
        $conn = mysqli_connect($serverHost, $serverUsername, $serverPassword, $dbName);
        if (!$conn) {
            die(mysqli_connect_error());
        }

        $sql = 'SELECT patient.pn, patient.last, patient.first, insurance.iname, DATE_FORMAT(insurance.from_date, "%m-%d-%y"), DATE_FORMAT(insurance.to_date, "%m-%d-%y")
        FROM insurance
        INNER JOIN patient ON insurance.patient_id=patient._id
        ORDER BY insurance.from_date ASC';
        
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
            if(is_null($row[5])){
                $row[5] = "Ongoing";
            }
            printf ("{$row[0]}, {$row[1]}, {$row[2]}, {$row[3]}, {$row[4]}, {$row[5]}\n");
        }

        mysqli_close($conn);
    }

    function getNameStat($serverHost, $serverUsername, $serverPassword, $dbName){
        $map = array();
        $total = 0;
        
        $conn = mysqli_connect($serverHost, $serverUsername, $serverPassword, $dbName);
        if (!$conn) {
            die(mysqli_connect_error());
        }

        $sql = "SELECT last, first FROM patient";
        
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
            $fullName = strtoupper($row[0].$row[1]);
            // var_dump($fullName);
            foreach (count_chars($fullName, 1) as $i => $val) {
                // var_dump(chr($i));
                if(ctype_alpha(chr($i))) {
                    if (array_key_exists(chr($i), $map)){
                        $map[chr($i)] = $map[chr($i)]+$val;
                        $total = $total+$val;
                        continue;
                    }
                    $map[chr($i)] = $val;
                    $total = $total+$val;
                }
            }
        }
        mysqli_close($conn);

        ksort($map);
        foreach ($map as $key => $val) {
            $percent = round($val/$total*100, 2);
            printf("{$key}\t{$val}\t{$percent}%%\n");
        }
    }

    getPatients($serverHost, $serverUsername, $serverPassword, $dbName);
    printf("\n");
    getNameStat($serverHost, $serverUsername, $serverPassword, $dbName);

?>
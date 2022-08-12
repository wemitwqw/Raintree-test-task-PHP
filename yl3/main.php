<?php 
    include 'Patient.php';
    include 'Insurance.php';

    $todayDate = date("m-d-y");

    $insurance = new Insurance(1, "Medica", "2020-09-01", "2021-09-01", "00000000015", 1);
    $insurance2 = new Insurance(2, "Telvet", "2021-09-02", "2024-09-02", "00000000015", 1);
    $insurance3 = new Insurance(3, "Blue Shield", "2018-02-25", "2021-02-25", "00000000234", 2);
    $insurance4 = new Insurance(4, "Medica", "2021-02-26", NULL, "00000000234", 2);
    $insurance5 = new Insurance(5, "Telvet", "2021-01-01", "2021-12-31", "00000001111", 3);
    $insurance6 = new Insurance(6, "Blue Shield", "2022-01-01", "2022-05-31", "00000001111", 3);
    
    $p1 = new Patient("1", "00000000015", "Rene", "Vaher", "2000-01-18", array($insurance, $insurance2));
    $p2 = new Patient("2", "00000000234", "Jaan", "Saar", "1997-05-12", array($insurance3, $insurance4));
    $p3 = new Patient("3", "00000001111", "Anne", "Kask", "2001-09-29", array($insurance5, $insurance6));

    $patients = array($p2, $p3, $p1);
    usort($patients, function($a, $b){
        return $a->get_id() <=> $b->get_id();
    });

    foreach($patients as $i => $j){
        $j->check_records($todayDate);
    }
?>
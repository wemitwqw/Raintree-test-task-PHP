<?php 
    include 'Patient.php';
    // include 'Insurance.php';

    $p1 = new Patient("1", "00000000015", "Rene", "Vaher", "2000-01-18", 
    array(new Insurance("00000000015", "1", 1, "Medica", "2020-09-01", "2021-09-01"), new Insurance("00000000015", "1", 2, "Telvet", "2021-09-02", "2024-09-02")));
    
    printf("\n");
    print_r($p1->get_records());
    printf("\n");
    $p1->check_records("06-09-23");
?>
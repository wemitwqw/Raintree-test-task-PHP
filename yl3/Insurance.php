<?php 
    // include 'PatientRecord.php';

    class Insurance implements PatientRecord {
        public $pn;
        public $patient_id;
        public $_id;
        public $iname;
        public $from_date;
        public $to_date;
        
        function __construct($pn, $patient_id, $_id, $iname, $from_date, $to_date) {
            $this->pn = $pn;
            $this->patient_id = $patient_id;
            $this->_id = $_id;
            $this->iname = $iname;
            $this->from_date = $from_date;
            $this->to_date = $to_date;
        }

        public function get_id(){
            return $this->_id;
        }

        public function get_pn(){
            return $this->pn;
        }
    }
?>
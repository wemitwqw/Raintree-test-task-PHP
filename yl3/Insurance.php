<?php 

    class Insurance implements PatientRecord {
        public $_id;
        public $iname;
        public $from_date;
        public $to_date;
        public $pn;
        public $patient_id;

        function __construct($_id, $iname, $from_date, $to_date, $pn, $patient_id) {
            $this->_id = $_id;
            $this->iname = $iname;
            $this->from_date = $from_date;
            $this->to_date = $to_date;
            $this->pn = $pn;
            $this->patient_id = $patient_id;
        }

        public function get_id(){
            return $this->_id;
        }

        public function get_pn(){
            return $this->pn;
        }

        public function check_date($input){
            $date = date_parse_from_format("m-d-y", $input);
            $date = "{$date['year']}-{$date['month']}-{$date['day']}";
            $date = strtotime($date);

            if(is_null($this->to_date)){
                $isValid = true;
            }
            if(!is_null($this->to_date)){
                $isValid = $date >= strtotime($this->from_date) && $date <= strtotime($this->to_date) ? true : false;
            }
            
            return $isValid;
        }
    }
?>
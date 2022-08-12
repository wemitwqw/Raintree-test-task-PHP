<?php 
    include 'PatientRecord.php';

    class Patient implements PatientRecord {
        public $_id;
        public $pn;
        public $first;
        public $last;
        public $dob;
        public $records = array();
        
        function __construct($_id, $pn, $first, $last, $dob, $records) {
            $this->_id = $_id;
            $this->pn = $pn;
            $this->first = $first;
            $this->last = $last;
            $this->dob = $dob;
            $this->records = $records;
        }

        public function get_id(){
            return $this->_id;
        }

        public function get_pn(){
            return $this->pn;
        }

        public function get_name(){
            return "{$this->first} {$this->last}";
        }

        public function get_records(){
            return $this->records;
        }

        public function check_records($input){
            $date = date_parse_from_format("m-d-y", $input);
            $date = "{$date['year']}-{$date['month']}-{$date['day']}";
            $date = strtotime($date);

            foreach($this->records as $key => $value){
                if(is_null($this->records[$key]->to_date)){
                    $isValid = "Yes";
                }
                if(!is_null($this->records[$key]->to_date)){
                    $isValid = $date >= strtotime($this->records[$key]->from_date) && $date <= strtotime($this->records[$key]->to_date) ? "Yes" : "No";
                }
                printf("{$this->pn}, {$this->get_name()}, {$this->records[$key]->iname}, {$isValid}");
                printf("\n");
            }
        }
    }
?>
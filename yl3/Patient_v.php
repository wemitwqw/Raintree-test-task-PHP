<?php 
    include 'PatientRecord.php';
    include 'Insurance.php';

    class Patient implements PatientRecord {
        public $_id;
        public $pn;
        public $first;
        public $last;
        public $dob;
        public $records = array();
        
        function __construct($pn) {
            $conn = mysqli_connect("localhost:3306", "root", "", "raintree");
            if (!$conn) {
                die(mysqli_connect_error());
                return "Error";
            }
            
            $sql = "SELECT _id, pn, first, last, dob 
            FROM patient
            WHERE patient.pn={$pn}";
            $result = mysqli_query($conn, $sql);
            $result = mysqli_fetch_array($result, MYSQLI_NUM);
            $this->_id = $result[0];
            $this->pn = $pn;
            $this->first = $result[2];
            $this->last = $result[3];
            $this->dob = $result[4];
            
            $sql = "SELECT insurance._id, insurance.iname, insurance.from_date, insurance.to_date 
            FROM insurance
            INNER JOIN patient ON insurance.patient_id=patient._id WHERE patient.pn={$pn}";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
                array_push($this->records, new Insurance($this->pn, $this->_id, $row[0], $row[1], $row[2], $row[3]));
            }
            mysqli_close($conn);
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
            // Patient Number, First Last, Insurance name, Is Valid
            foreach($this->records as $key => $value){
                $isValid = $date >= strtotime($this->records[$key]->from_date) && $date <= strtotime($this->records[$key]->to_date) ? "Yes" : "No";
                printf("{$this->pn}, {$this->get_name()}, {$this->records[$key]->iname}, {$isValid}");
                printf("\n");
            }
        }
    }
?>
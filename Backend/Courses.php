<?php
    trait Courses{
        private $courseID;
        private $courseName;
        public function __construct($CID,$CN){
            $this->courseID=$CID;
            $this->courseName=$CN;
        }
        public function getCID(){
            return $this->courseID;
        }
        public function getCN(){
            return $this->courseName;
        }
    }
?>
<?php
    trait Fees{
        private $tchsalary;
        private $adsalary;
        private $accsalary;
        private $semesterfee;
        private $studentfee;
        public function setTeachSal($ts){
            $this->tchsalary=$ts;
        }
        public function setAccSal($accs){
            $this->accsalary=$accs;
        }
        public function setAdminSal($as){
            $this->adsalary=$as;
        }
        public function setSemFee($sf){
            $this->semesterfee=$sf;
        }
        public function SetStFee($stf){
            $this->studentfee=$stf;
        }
        public function getTeacherSalary(){
            return $this->tchsalary;
        }
        public function getAdminSalary(){
            return $this->adsalary;
        }
        public function getAccountantSalary(){
            return $this->accsalary;
        }
        public function getSemesterFee(){
            return $this->semesterfee;
        }
        public function getStudentFee(){
            return $this->studentfee;
        }
    }
?>
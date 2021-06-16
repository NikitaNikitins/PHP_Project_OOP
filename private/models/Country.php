<?php 

    namespace Models;

    class Country {

        private $Name;
        private $Code;
        private $Phone;


        public function getName() :string {
            return $this->Name;
        }

        public function getCode() :string {
            return $this->Code;
        }

        public function getPhoneCode() :int {
            return $this->Phone;
        }
    }
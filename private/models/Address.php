<?php 

    namespace Models;

    class Address {

        private $Address;
        private $City;
        private $country;
        private $CountryId;

        function __construct($Address, $City, $CountryId)
        {
            $this->Address = $Address;
            $this->City = $City;
            $this->CountryId = $CountryId;
        }

        public function getAddress() :string {
            return $this->Address;
        }

        public function getCity() :string {
            return $this->City;
        }

        public function getCountryId() : int {
            return $this->CountryId;
        }
    }
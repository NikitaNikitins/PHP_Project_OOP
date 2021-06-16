<?php

    namespace Models;

    class OrderedProject {

        private $Id;
        private $OrderedProjectCustomerId;
        private $Status;
        private $ProjectDescriptionId;
        private $ProjectDescription;

        public const FINISHED_PROJECT = 4;
        public const PROJECT_IN_PROGRESS = 3;

        public function setOrderedProjectCustomerId($customerId) {
            $this->OrderedProjectCustomerId = $customerId;
        }

        public function getOrderedProjectCustomerId(): int {
            return $this->OrderedProjectCustomerId;
        }

        public function setStatus($status) {
            $this->Status = $status;
        }

        public function getStatus(): int {
            return $this->Status;
        }

        // public function getProjectDescription():
    }

<?php

    namespace Processer\Authentication;

    interface UserInterface
    {
        public function getUsername() :?string;

        public function getPassword() :?string;

        public function getRole() :?int;
    }
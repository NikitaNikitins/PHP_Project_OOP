<?php

    namespace Models;

    class UserRole {
        const ADMIN = 1;
        const BUILDER = 2;
        const CLIENT = 3;

        public static function getAdminRole() : int {
            return self::ADMIN;
        }

        public static function getBuilderRole() : int {
            return self::BUILDER;
        }

        public static function getClientRole() : int {
            return self::CLIENT;
        }
    }
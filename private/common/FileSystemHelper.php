<?php 

    namespace FileSystemWorker;
    define( 'ABSOLUTE_PATH', dirname(__FILE__));

    class FileSystemHelper {
        const IMAGES_FOLDER = ABSOLUTE_PATH . DIRECTORY_SEPARATOR ."images";

        public static function getCompletedProjectImagesFolder() {
            return self::IMAGES_FOLDER. DIRECTORY_SEPARATOR. "project-images". DIRECTORY_SEPARATOR ."completed-projects-images";
        }
    }
<?php

// require 'models/project.php';

class FinishedProjects {
    private $imgPath = "";
    protected $FinishDate;
    protected $ProjectDescription;
    protected $ProjectTitle;
    private $constantImagesPath = "D://XAMPP/htdocs/php_project/PHP_Project_OOP/private/common/images/project-images/completed-projects-images/";

    public function route($data) {
        // GET /finishedProjects all
        if ($data['method'] === 'GET' && count($data['urlData']) === 1) {
            echo json_encode($this->getFinishedProjects());
            exit;
        }

        // Ja bija nepareizs routers
        \Helpers\throwHttpError('invalid_parameters', 'invalid parameters');
    }

    private function getFinishedProjects()
    {
        $pdo = \Helpers\connectToDB();

        $query = 'CALL  get_finished_projects_with_images()';

        $data = $pdo->prepare($query);
        $data->execute();

        $fetchedData = $data->fetchAll();

        foreach ($fetchedData as $key=>$value) {
                $fetchedData[$key]['MainImage']= $this->convertImageToBase64($fetchedData[$key]['Id'], $fetchedData[$key]['ImagePath']);
            }

        return $fetchedData;
    }

    private function convertImageToBase64($Id, $ImagePath) {
        try {
            $src =FileSystemWorker\FileSystemHelper::getCompletedProjectImagesFolder().DIRECTORY_SEPARATOR. $Id. DIRECTORY_SEPARATOR. $ImagePath;

            if(file_exists($src)){
                $imgData = base64_encode(file_get_contents($src));
                return 'data: '.mime_content_type($src).';base64,'.$imgData;
            }
        } catch (\Throwable $th) {
            return '';
        }
    }

    private function GetProjectMainImage($Id) {
        $pdo = \Helpers\connectToDB();

        $query = 'SELECT img.Id,img.ImagePath
        from projectimages AS img
        WHERE img.ProjectId =:id AND img.IsMainImage =1 limit 1';

        $data = $pdo->prepare($query);
        $data->bindParam(':id',$Id, PDO::PARAM_INT);

        $data->execute();

        $imagesData = $data->fetchAll();

        if(!empty($imagesData))
            return $this->convertImagesToBase64($imagesData, $Id)[0]['imgContent'];
    }

    private function convertImagesToBase64($data, $projectId)
    {
        $result = array();

        foreach ($data as $key=>$value) {
            $result[$key]['imgContent']= $this->convertImageToBase64($projectId, $data[$key]['ImagePath']);
        }

        return $result;
    }
}

function getRoute($data){
    $instance = new FinishedProjects();

    return $instance->route($data);
}

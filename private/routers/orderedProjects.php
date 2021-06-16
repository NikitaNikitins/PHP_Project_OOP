<?php
use databaseModels\OrderedProject;

class OrderedProjectController {

    private $FINISHED_PROJECT_VAL;
    private $PROJECT_IN_PROGRESS_VAL;

    public function __construct()
    {
        $this->FINISHED_PROJECT_VAL = Models\OrderedProject::FINISHED_PROJECT;
        $this->PROJECT_IN_PROGRESS_VAL = Models\OrderedProject::PROJECT_IN_PROGRESS;
    }

    public function route($data) {
        //creating new finished Project
        if($data['method'] === 'POST'
            && $data['urlData'][1] === 'createNewFinishedProject'
            && count($data['urlData']) === 2){
            $projectData = json_decode(file_get_contents('php://input'), true);
            //$targetImageUploadDir = $src =FileSystemWorker\FileSystemHelper::getCompletedProjectImagesFolder().DIRECTORY_SEPARATOR.'23'. DIRECTORY_SEPARATOR;

            $pdo = \Helpers\connectToDB();
            $stmt = $pdo->prepare("
            BEGIN;
            INSERT INTO orderedprojects(StartDate, FinishDate, Address, City) VALUES(:startDate, :FinishDate, :Address, :City);
            INSERT INTO projectsinprogress(ProjectId, EmployedCount, ProjectDescription, ProjectTitle, Status)
                VALUES(LAST_INSERT_ID(), :employedCount, :projectDescription, :projectTitle, :status);
            COMMIT;");

            $stmt->bindParam(':startDate',$projectData['startDate'], PDO::PARAM_STR);
            $stmt->bindParam(':FinishDate',$projectData['finishDate'], PDO::PARAM_STR);
            $stmt->bindParam(':Address',$projectData['address'], PDO::PARAM_STR);
            $stmt->bindParam(':City',$projectData['city'], PDO::PARAM_STR);

            $stmt->bindParam(':employedCount',$projectData['employedCount'], PDO::PARAM_INT);
            $stmt->bindParam(':projectDescription',$projectData['description'], PDO::PARAM_STR);
            $stmt->bindParam(':projectTitle',$projectData['title'], PDO::PARAM_STR);
            $stmt->bindParam(':status',$this->FINISHED_PROJECT_VAL, PDO::PARAM_INT);

            try {
                $stmt->execute();
                \Helpers\HttpSuccess("Finished project is added to the database!");
            } catch (PDOException $e) {
                \Helpers\throwHttpError('finished_project_add_error', 'Error while saving project to the database!');
            }

            exit;
        }

        //get projects to finish as options for select list items
        if ($data['method'] === 'GET' && $data['urlData'][1] === 'getProjectsToFinish' && count($data['urlData']) === 2) {
            echo json_encode($this->getOrderedProjects());
            exit;
        }

        // // GET /projects all
        // if ($data['method'] === 'GET' && count($data['urlData']) === 1) {
        //     echo json_encode($this->getOrderedProjects());
        //     exit;
        // }

        // // GET /projects/:$id
        // if ($data['method'] === 'GET' && count($data['urlData']) === 2) {
        //     $id = (int)$data['urlData'][1];
        //     echo json_encode($this->getOrderedProject($id));
        //     exit;
        // }

        // GET /orderedProjects/finishProject/:$id
        if ($data['method'] === 'GET' && $data['urlData'][1] === 'finishProject' &&  count($data['urlData']) === 3) {
            $id = (int)$data['urlData'][2];
            echo json_encode($this->finishOrderedProject($id));
            exit;
        }

        // // POST /projects
        // if ($data['method'] === 'POST'
        //     && count($data['urlData']) === 1
        //     && isset($data['formData']['orderedProjectCustomerId'])
        //     && isset($data['formData']['startDate'])
        //     && isset($data['formData']['plannedEndDate'])
        //     && isset($data['formData']['adress'])
        //     && isset($data['formData']['city'])) {

        //         $this->OrderedProjectCustomerId= $data['formData']['startDate'];
        //         $this->StartDate = $data['formData']['plannedEndDate'];
        //         $this->PlannedEndDate = $data['formData']['orderedProjectCustomerId'];
        //         $this->Address = $data['formData']['adress'];
        //         $this->City = $data['formData']['city'];

        //     echo json_encode($this->addProject());
        //     exit;
        // }

        // // PUT /projects/5
        // if ($data['method'] === 'PUT'
        //     && count($data['urlData']) === 1
        //     && isset($data['formData']['orderedProjectCustomerId'])
        //     && isset($data['formData']['startDate'])
        //     && isset($data['formData']['plannedEndDate'])
        //     && isset($data['formData']['adress'])
        //     && isset($data['formData']['city'])) {

        //         $this->OrderedProjectCustomerId= $data['formData']['startDate'];
        //         $this->StartDate = $data['formData']['plannedEndDate'];
        //         $this->PlannedEndDate = $data['formData']['orderedProjectCustomerId'];
        //         $this->Address = $data['formData']['adress'];
        //         $this->City = $data['formData']['city'];

        //     echo json_encode($this->updateProject());
        //     exit;
        // }

        // // DELETE /projects/5
        // if ($data['method'] === 'DELETE' && count($data['urlData']) === 2) {
        //     $id = (int)$data['urlData'][1];

        //     echo json_encode($this->deleteProject($id));
        //     exit;
        // }

        // Ja bija nepareizs routers
        //\Helpers\throwHttpError('invalid_parameters', 'invalid parameters');
    }

    private function getOrderedProjectsToFinish() {
        $pdo = \Helpers\connectToDB();
        $query = 'SELECT p.Id, p.Address, p.City, p.StartDate, users.FullName
        from orderedprojects p, customers,users, projectsinprogress
        WHERE p.OrderedProjectCustomerId = customers.Id
        AND customers.UserId = users.Id
        AND projectsinprogress.ProjectId = p.Id
        AND projectsinprogress.Status = 3';

        $data = $pdo->prepare($query);
        $data->execute();
        return $data->fetchAll();
    }

    private function getOrderedProjects()
    {
        $pdo = \Helpers\connectToDB();
        $query = 'CALL get_projects_in_progress(:projectInProgressStatus)';

        $data = $pdo->prepare($query);
        $data ->bindParam(':projectInProgressStatus', $this->PROJECT_IN_PROGRESS_VAL, PDO::PARAM_INT);
        $data->execute();

        return $data->fetchAll();
    }

    private function finishOrderedProject($ProjectId)
    {
        $pdo = \Helpers\connectToDB();

        $query = 'UPDATE projectsinprogress SET projectsinprogress.Status = 2 WHERE ProjectId=:id';

        $data = $pdo->prepare($query);
        $data->bindParam(':id',$ProjectId, PDO::PARAM_INT);
        $data->execute();
    }

    // private function getOrderedProject($id)
    // {
    //     $pdo = \Helpers\connectToDB();

    // // Throwing an error if project doesnt exist
    //     if (!\Helpers\isExistsOrderedProjectById($pdo, $id)) {
    //         \Helpers\throwHttpError('ordered_project_not_exists', 'ordered project not exists');
    //         exit;
    //     }

    //     $query = 'SELECT p.Id, p.OrderedProjectCustomerId, p.StartDate, p.PlannedEndDate, p.Address, p.City, c.Id from orderedprojects, customers c where p.id=:id AND  p.OrderedProjectCustomerId = c.Id';

    //     $data = $pdo->prepare($query);
    //     $data->bindParam(':id', $id, PDO::PARAM_INT);
    //     $data->execute();

    //     return $data->fetch();
    // }

    // private function addProject()
    // {
    //     $pdo = \Helpers\connectToDB();

    //     // Добавляем товар в базу
    //     $query = 'insert into orderedprojects (OrderedProjectCustomerId, StartDate, PlannedEndDate, Address, City)
    //         values (:orderedProjectCustomerId, :startDate, :plannedEndDate, :address, :city)';
    //     $data = $pdo->prepare($query);
    //     $data->bindParam(':orderedProjectCustomerId',$this->OrderedProjectCustomerId, PDO::PARAM_INT);
    //     $data->bindParam(':startDate', $this->StartDate);
    //     $data->bindParam(':plannedEndDate', $this->PlannedEndDate);
    //     $data->bindParam(':address', $this->Address);
    //     $data->bindParam(':city',  $this->City);
    //     $data->execute();
    // }

    // private function updateProject()
    // {
    //     $pdo = \Helpers\connectToDB();

    //     // Обновляем товар в базе
    //     $query = 'update orderedprojects set OrderedProjectCustomerId=:orderedProjectCustomerId, StartDate=:startDate, PlannedEndDate=:plannedEndDate, Address=:address, City=:city where id=:id';
    //     $data = $pdo->prepare($query);
    //     $data->bindParam(':orderedProjectCustomerId',$this->OrderedProjectCustomerId, PDO::PARAM_INT);
    //     $data->bindParam(':startDate', $this->StartDate);
    //     $data->bindParam(':plannedEndDate', $this->PlannedEndDate);
    //     $data->bindParam(':address', $this->Address);
    //     $data->bindParam(':city',  $this->City);
    //     $data->execute();
    // }

    // private function deleteProject()
    // {
    //     $pdo = \Helpers\connectToDB();

    //     // Если товар не существует, то выбрасываем ошибку
    //     if (!\Helpers\isExistsOrderedProjectById($pdo, $this->id)) {
    //         \Helpers\throwHttpError('project_not_exists', 'project not exists');
    //         exit;
    //     }

    //     // Удаляем товар из базы
    //     $query = 'delete from orderedprojects where id=:id';
    //     $data = $pdo->prepare($query);
    //     $data->bindParam(':id', $id, PDO::PARAM_INT);
    //     $data->execute();
    // }
}

function getRoute($data){
    $instance = new OrderedProjectController();

    return $instance->route($data);
}

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

            $mainImage = $projectData['projectImages'][0];
            $stmt = $pdo->prepare("
            CALL create_new_finished_project(:Address, :City, :text, :FinishDate, :StartDate, :Title, :employedCount, :moneySpent, :mainImage )");

            $stmt->bindParam(':StartDate',$projectData['startDate'], PDO::PARAM_STR);
            $stmt->bindParam(':FinishDate',$projectData['finishDate'], PDO::PARAM_STR);
            $stmt->bindParam(':Address',$projectData['address'], PDO::PARAM_STR);
            $stmt->bindParam(':City',$projectData['city'], PDO::PARAM_STR);

            $stmt->bindParam(':employedCount',$projectData['employedCount'], PDO::PARAM_INT);
            $stmt->bindParam(':moneySpent',$projectData['moneySpent']);
            $stmt->bindParam(':text',$projectData['text'], PDO::PARAM_STR);
            $stmt->bindParam(':Title',$projectData['title'], PDO::PARAM_STR);
            $stmt->bindParam(':mainImage',$mainImage, PDO::PARAM_STR);

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

        // GET /orderedProjects/finishProject/:$id
        if ($data['method'] === 'GET' && $data['urlData'][1] === 'finishProject' &&  count($data['urlData']) === 3) {
            $id = (int)$data['urlData'][2];
            echo json_encode($this->finishOrderedProject($id));
            exit;
        }

        //delete orderedproject
        // DELETE /orderedProjects/5
        if ($data['method'] === 'DELETE' && count($data['urlData']) === 2) {
            $id = (int)$data['urlData'][1];
            $pdo = \Helpers\connectToDB();

            $stmt = 'DELETE FROM unitedconstuctiongroup.orderedprojects WHERE Id =:id';

            try{
                $query = $pdo->prepare($stmt);
                $query->bindParam(':id',$id, PDO::PARAM_INT);
                $query->execute();
                \Helpers\HttpSuccess("Ordered project is deleted!");
            }
            catch (PDOException $e) {
                \Helpers\throwHttpError('project_delete_error', "$e");
            }
            exit;
        }
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

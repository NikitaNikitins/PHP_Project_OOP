<?php
//Using Model- View- Controller design pattern
class WorkerController {

    public function route($data) {
        //get workers list
        if($data['method'] === 'GET' && $data['urlData'][1] =='getWorkersList' && count($data['urlData']) === 2) {
            echo json_encode($this->getWorkersList());
            exit;
        }

        //get Worker by id
        // GET //workers/getWorkerById
        if ($data['method'] === 'GET' && count($data['urlData']) === 2 && $data['urlData'][1] === 'getWorkerById') {
            $workerId = (int)$data['formData']['workerId'];
            $pdo = \Helpers\connectToDB();

            $stmt = 'SELECT u.Id, u.UserName, u.Email, u.RoleId, u.PhoneNumber, u.FirstName, u.LastName, a.Address, a.City, c.Name, c.Code, a.CountryId FROM users u
            left JOIN `address` a ON u.AddressId = a.Id
            left JOIN country c ON a.CountryId = c.Id
            WHERE u.Id =:userId';

            try{
                $query = $pdo->prepare($stmt);
                $query->bindParam(':userId',$userId, PDO::PARAM_INT);
                $query->execute();
                $data = $query->fetch();
                echo json_encode($data);
            }
            catch (PDOException $e) {
                \Helpers\throwHttpError('user_retrieve_error', "$e");
            }
            exit;
        }

        //delete Worker
        // DELETE /workers/5
        if ($data['method'] === 'DELETE' && count($data['urlData']) === 2) {
            $workerId = (int)$data['urlData'][1];
            $pdo = \Helpers\connectToDB();

            $stmt = 'DELETE workers FROM workers 
            LEFT JOIN `address` ON users.AddressId = `address`.Id
            WHERE users.Id=:userId';

            try{
                $query = $pdo->prepare($stmt);
                $query->bindParam(':userId',$userId, PDO::PARAM_INT);
                $query->execute();
                \Helpers\HttpSuccess("User is deleted!");
            }
            catch (PDOException $e) {
                \Helpers\throwHttpError('user_delete_error', "$e");
            }
            exit;
        }
    }

    private function getWorkersList() {

    }
}

function getRoute($data){
    $instance = new WorkerController();

    return $instance->route($data);
}
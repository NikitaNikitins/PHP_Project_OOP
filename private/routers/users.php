<?php
// https://github.com/devcoder-xyz/php-user-authentication
//Using Model- View- Controller design pattern


use Processer\Authentication\Core\UserManager;
use Models\User;
use Models\Address;

class UserController {

    public function route($data) {
        //get registration form Options
        if ($data['method'] === 'GET' && $data['urlData'][1] === 'getRegisterFormOptions' && count($data['urlData']) === 2) {
            echo json_encode($this->getRegisterFormOptions());
            exit;
        }

        //get users list
        if($data['method'] === 'GET' && $data['urlData'][1] =='getUserList' && count($data['urlData']) === 2) {
            echo json_encode($this->getUsersList());
            exit;
        }

        //get User by id
        // GET /users/getUserById
        if ($data['method'] === 'GET' && count($data['urlData']) === 2 && $data['urlData'][1] === 'getUserById') {
            $userId = (int)$data['formData']['userId'];
            $pdo = \Helpers\connectToDB();

            $stmt = 'CALL get_user_to_preview(:userId)';

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

        //edit user
        // POST /users/edit
        if ($data['method'] === 'POST' && $data['urlData'][1] === 'edit' &&  count($data['urlData']) === 2) {
            $userData = json_decode(file_get_contents('php://input'), true);

            $userName = $userData['UserName'];
            $email = $userData['Email'];
            $phone = $userData['PhoneNumber'];
            $firstName = $userData['FirstName'];
            $lastName = $userData['LastName'];
            $addr = $userData['Address'];
            $city = $userData['City'];
            $countryId = (int)$userData['CountryId'];
            $userId = $userData['Id'];
            $roleId = (int)$userData['RoleId'];

            $pdo = \Helpers\connectToDB();

            $stmt = '
            SELECT edit_user(:userName, :email, :firstName, :phone, :lastName, :roleId, :addr, :city, :countryId, :userId);';

            try{
                $query = $pdo->prepare($stmt);

                $query->bindParam(':userId',$userId, PDO::PARAM_INT);
                $query->bindParam(':city',$city, PDO::PARAM_STR);
                $query->bindParam(':countryId',$countryId, PDO::PARAM_INT);
                $query->bindParam(':addr',$addr, PDO::PARAM_STR);
                $query->bindParam(':lastName',$lastName, PDO::PARAM_STR);
                $query->bindParam(':firstName',$firstName, PDO::PARAM_STR);
                $query->bindParam(':phone',$phone, PDO::PARAM_STR);
                $query->bindParam(':email',$email, PDO::PARAM_STR);
                $query->bindParam(':userName',$userName, PDO::PARAM_STR);
                $query->bindParam(':roleId',$roleId, PDO::PARAM_INT);

                $query->execute();
                \Helpers\HttpSuccess("User is updated!");
            }
            catch (PDOException $e) {
                \Helpers\throwHttpError('user_updated_error', "$e");
            }
            exit;
        }

        //delete User
        // DELETE /users/5
        if ($data['method'] === 'DELETE' && count($data['urlData']) === 2) {
            $userId = (int)$data['urlData'][1];
            $pdo = \Helpers\connectToDB();

            $stmt = 'SELECT delete_user(:userId)';

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

    private function getRegisterFormOptions() {
        $pdo = \Helpers\connectToDB();
        $query = 'SELECT p.Id, p.Name, p.Code
        from country p';

        $data = $pdo->prepare($query);
        $data->execute();
        return $data->fetchAll();
    }

    private function getUsersList() {
        $pdo = \Helpers\connectToDB();
        $query = 'SELECT u.Id, u.UserName, u.Email, u.PhoneNumber, u.FullName, u.IsEnabled, u.RoleId
        from users u';

        $data = $pdo->prepare($query);
        $data->execute();
        return $data->fetchAll();
    }
}

function getRoute($data){
    $instance = new UserController();

    return $instance->route($data);
}

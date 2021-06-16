<?php
// https://github.com/devcoder-xyz/php-user-authentication
//Using Model- View- Controller design pattern


use Processer\Authentication\Core\UserManager;
use Models\User;
use Models\Address;

class AuthController {
    private $userManager;
    private $adminRole = 1;
    private $builderRole = 2;
    private $clientRole = 3;

    public function __construct()
    {
        $this->userManager = new UserManager();
    }

    public function route($data) {

        // register user
        if ($data['method'] === 'POST'
            && $data['urlData'][1] === 'register'
            && count($data['urlData']) === 2) {
                $userData = json_decode(file_get_contents('php://input'), true);

                $address = (new Address($userData['address'], $userData['city'], $userData['countryId']));

                $password = $this->userManager->cryptPassword($userData['password']);
                $user = (new User())
                    ->setUserName($userData['userName'])
                    ->setEmail($userData['email'])
                    ->setFirstName($userData['firstName'])
                    ->setLastName($userData['lastName'])
                    ->setPassword($password)
                    // ->setRoles(UserRole::getAdminRole());
                    ->setRoles($userData['userRole'])
                    ->setAddress($address);

                try {
                    $this->registerUser($user);
                    // to use for auth
                    // $this->userManager->createUserToken($user);
                    \Helpers\HttpSuccess("User is registered!");
                } catch (PDOException $e) {
                    \Helpers\throwHttpError("registration_error: $e", 'Registration error!');
                }

                exit;
        }

        if ($data['method'] === 'POST' && $data['urlData'][1] === 'login' &&  count($data['urlData']) === 2) {
            $userData = json_decode(file_get_contents('php://input'), true);

            $pdo = \Helpers\connectToDB();
            $stmt = $pdo->prepare("SELECT * FROM users WHERE UserName=:username");
            $stmt->bindParam(':username',$userData['username'], PDO::PARAM_STR);
            $stmt->execute();
            $userFromDataBase = $stmt->fetch();

            if(empty($userFromDataBase))
                return \Helpers\throwHttpError('login_error', 'No such user!');

            $user = (new User())
                ->setUserName($userFromDataBase['UserName'])
                ->setPassword($userFromDataBase['PasswordHash'])
                ->setRoles($userFromDataBase['RoleId'])
                ->setEnabled($userFromDataBase['IsEnabled']);

            $userManager = new UserManager();
            if($userManager->isPasswordValid($user, $userData['password'])){

                // login OK, set Token in session
                $userManager->createUserToken($user);

            }else {
                \Helpers\throwHttpError('invalid_router', 'Invalid credentials');
            }
        }
    }

    private function registerUser(User $user) {
        $pdo = \Helpers\connectToDB();

        $userName = $user->getUsername();
        $password = $user->getPassword();
        $firstName =$user->getFirstName() ;
        $lastName =$user->getLastName() ;
        $email =$user->getEmail();
        $userRole = $user->getRole();
        $city = $user->getAddress()->getCity();
        $countryId = $user->getAddress()->getCountryId();
        $address = $user->getAddress()->getAddress();

        $stmt = $pdo->prepare("SELECT insert_new_user(:username, :email, :passwordHash, :firstName,'20317330', :lastName, :roleId, :address, :city, :countryId);");

        $stmt->bindParam(':username',$userName, PDO::PARAM_STR);
        $stmt->bindParam(':email',$email, PDO::PARAM_STR);
        $stmt->bindParam(':passwordHash',$password, PDO::PARAM_STR);
        $stmt->bindParam(':firstName',$firstName, PDO::PARAM_STR);
        $stmt->bindParam(':lastName',$lastName, PDO::PARAM_STR);
        $stmt->bindParam(':roleId',$userRole, PDO::PARAM_INT);
        $stmt->bindParam(':address',$address, PDO::PARAM_STR);
        $stmt->bindParam(':city',$city, PDO::PARAM_STR);
        $stmt->bindParam(':countryId',$countryId, PDO::PARAM_INT);
        $stmt->execute();
    }
}

function getRoute($data){
    $instance = new AuthController();

    return $instance->route($data);
}

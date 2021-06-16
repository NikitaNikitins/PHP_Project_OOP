<?php

    namespace Processer\Authentication\Core {
    use Processer\Authentication\Token\UserToken;
    use Processer\Authentication\Token\UserTokenInterface;
    use Processer\Authentication\UserInterface;

    class UserManager implements UserManagerInterface
    {
        use PasswordTrait;

        public function __construct()
        {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
        }
        
        public function getUserToken(): ?UserTokenInterface
        {
            $userToken = null;
            if ($this->hasUserToken()) {
                $userToken = unserialize($_SESSION[UserTokenInterface::DEFAULT_PREFIX_KEY]);
            }

            return $userToken;
        }

        public function hasUserToken(): bool
        {
            $key = UserTokenInterface::DEFAULT_PREFIX_KEY;
            return (array_key_exists($key, $_SESSION) && unserialize($_SESSION[$key]) !== false);
        }

        public function isGranted(int $role): bool
        {
            if (!is_null($userToken = $this->getUserToken())) {
                return false;
            }

            if ($userToken->getUser() instanceof UserInterface) {
                return $userToken->getUser()->getRole() === $role;
            }

            return false;
        }

        public function createUserToken(UserInterface $user): UserTokenInterface
        {
            $userToken = new UserToken($user);
            $_SESSION[UserTokenInterface::DEFAULT_PREFIX_KEY] = $userToken->serialize();

            return $userToken;
        }

        public function logout(): void
        {
            if ($this->hasUserToken()) {
                unset($_SESSION[UserTokenInterface::DEFAULT_PREFIX_KEY]);
            }
        }
    }
}
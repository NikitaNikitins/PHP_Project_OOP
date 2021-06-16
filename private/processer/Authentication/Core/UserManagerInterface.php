<?php 

    namespace Processer\Authentication\Core;

    use Processer\Authentication\UserInterface;
    use Processer\Authentication\Token\UserTokenInterface;

    interface UserManagerInterface
    {
        public function getUserToken(): ?UserTokenInterface;

        public function hasUserToken(): bool;

        public function createUserToken(UserInterface $user): UserTokenInterface;

        public function logout(): void;

        public function cryptPassword(string $plainPassword): string;

        public function isPasswordValid(UserInterface $user, string $plainPassword): bool;
    }
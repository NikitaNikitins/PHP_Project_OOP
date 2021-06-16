<?php 

    namespace Processer\Authentication\Core;

    use Processer\Authentication\UserInterface;

    // traits are a mechanism for code reuse in single inheritance languages such as PHP. A Trait is intended to reduce some limitations of single inheritance by enabling a developer to reuse sets of methods freely in several independent classes living in different class hierarchies.

    trait PasswordTrait
    {
        private $cost = 10;

        public function cryptPassword(string $plainPassword): string
        {
            return password_hash($plainPassword, PASSWORD_BCRYPT, ['cost' => $this->cost]);
        }

        public function isPasswordValid(UserInterface $user, string $plainPassword): bool
        {
            return password_verify($plainPassword, $user->getPassword());
        }

        public function setCost(int $cost): void
        {
            if ($cost < 4 || $cost > 12) {
                throw new \InvalidArgumentException('Cost must be in the range of 4-31.');
            }
            $this->cost = $cost;
        }
    }
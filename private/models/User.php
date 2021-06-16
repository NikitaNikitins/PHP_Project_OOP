<?php 

    namespace Models;
    use Processer\Authentication\UserInterface;

    class User implements UserInterface
    {
        private $userName;

        private $password;

        private $role;

        private $email;
        private $firstName;
        private $lastName;
        private $phone;
        private $address;

        private $enabled = true;

        public function getUsername(): ?string
        {
            return $this->userName;
        }

        public function getPassword(): ?string
        {
            return $this->password;
        }

        public function getRole(): ?int
        {
            return $this->role;
        }

        public function setUserName(string $userName): self
        {
            $this->userName = $userName;
            return $this;
        }

        public function setPassword(string $password): self
        {
            $this->password = $password;
            return $this;
        }

        public function setRoles(int $role): self
        {
            $this->role = $role;
            return $this;
        }

        public function isEnabled(): bool
        {
            return $this->enabled;
        }

        public function setEnabled(bool $enabled): self
        {
            $this->enabled = $enabled;
            return $this;
        }

        public function setFirstName(string $firstName): self {
            $this->firstName = $firstName;
            return $this;
        }

        public function getFirstName(): ?string {
            return $this->firstName;
        }

        public function setLastName(string $lastName): self {
            $this->lastName = $lastName;
            return $this;
        }

        public function getLastName(): ?string {
            return $this->lastName;
        }

        public function setEmail(string $email): self {
            $this->email = $email;
            return $this;
        }

        public function getEmail() :?string {
            return $this->email;
        }

        public function setPhone(string $phone) :self {
            $this->phone = $phone;
            return $this;
        }

        public function getPhone(): ?string {
            return $this->phone;
        }

        public function setAddress(Address $address): self {
            $this->address = $address;
            return $this;
        }

        public function getAddress() : Address {
            return $this->address;
        }
    }
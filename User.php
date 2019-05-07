<?php

class User
{
    protected $email = "";
    protected $nom = "";
    protected $prenom = "";
    protected $age = 0;

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return User
     */
    public function setEmail(string $email): User
    {
        if ( !preg_match ( " /^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/ " , $email ) ){
            throw new InvalidArgumentException('L\'email est invalide');
        }
        $this->email = $email;

        return $this;
    }

    /**
     * @return string
     */
    public function getNom(): string
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     * @return User
     */
    public function setNom(string $nom): User
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return string
     */
    public function getPrenom(): string
    {
        return $this->prenom;
    }

    /**
     * @param string $prenom
     * @return User
     */
    public function setPrenom(string $prenom): User
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * @return int
     */
    public function getAge(): int
    {
        return $this->age;
    }

    /**
     * @param int $age
     * @return User
     */
    public function setAge(int $age): User
    {
        if ($age < 13) {
            throw new InvalidArgumentException('L\'age doit être supérieur à 13 ans');
        }
        $this->age = $age;

        return $this;
    }

    public function isValid()
    {
        return !($this->isEmpty($this->getNom()) || $this->isEmpty($this->getPrenom()) || $this->isEmpty($this->getEmail()) || $this->isEmpty($this->getAge()));
    }

    protected function isEmpty($data) {
        return $data === null || $data === '';
    }
}
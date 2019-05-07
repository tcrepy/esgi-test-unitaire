<?php

class Product
{
    protected $nom = '', $owner = null;

    /**
     * @return string
     */
    public function getNom(): string
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     * @return Product
     */
    public function setNom(string $nom): Product
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return null
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * @param User $owner
     * @return Product
     */
    public function setOwner(User $owner): Product
    {
        if (!$owner->isValid()) {
            throw new InvalidArgumentException('L\'utilisateur n\'est pas valide');
        }
        $this->owner = $owner;

        return $this;
    }

    public function isValid()
    {
        return !(Helper::isEmpty($this->getNom()) || Helper::isEmpty($this->owner));
    }
}
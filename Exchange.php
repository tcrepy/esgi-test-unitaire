<?php

class Exchange
{
    protected $receiver, $product, $endDate, $startDate, $mailSender, $DBConnexion;

    /**
     * @return mixed
     */
    public function getReceiver()
    {
        return $this->receiver;
    }

    /**
     * @param mixed $receiver
     * @return Exchange
     */
    public function setReceiver(User $receiver): Exchange
    {
        $this->receiver = $receiver;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @param mixed $product
     * @return Exchange
     */
    public function setProduct(Product $product): Exchange
    {
        $this->product = $product;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * @param mixed $endDate
     * @return Exchange
     */
    public function setEndDate(DateTime $endDate): Exchange
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * @param mixed $startDate
     * @return Exchange
     */
    public function setStartDate(DateTime $startDate): Exchange
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getMailSender()
    {
        return $this->mailSender;
    }

    /**
     * @param mixed $mailSender
     * @return Exchange
     */
    public function setMailSender($mailSender): Exchange
    {
        $this->mailSender = $mailSender;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDBConnexion()
    {
        return $this->DBConnexion;
    }

    /**
     * @param mixed $DBConnexion
     * @return Exchange
     */
    public function setDBConnexion($DBConnexion): Exchange
    {
        $this->DBConnexion = $DBConnexion;

        return $this;
    }

    public function save() {
        if ($this->isValid()) {
            $this->getDBConnexion()->save();
            if ($this->getReceiver()->getAge() < 18) {
                $this->getMailSender()->sendEmail();
            }
            return true;
        } else {
            return false;
        }
    }

    public function isValid()
    {
        return $this->getProduct()->isValid() &&
            $this->getProduct()->getOwner()->isValid() &&
            $this->getStartDate() > new \DateTime() &&
            $this->getEndDate() > $this->getStartDate();
    }
}
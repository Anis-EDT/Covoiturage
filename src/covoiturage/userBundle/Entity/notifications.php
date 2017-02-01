<?php

namespace covoiturage\userBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * notifications
 *
 * @ORM\Table(name="notifications")
 * @ORM\Entity(repositoryClass="covoiturage\userBundle\Repository\notificationsRepository")
 */
class notifications
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="message", type="string", length=255)
     */
    private $message;
    /**
     * @ORM\ManyToOne(targetEntity="annonce")
     */
    private $Annonce;
    /**
     * @ORM\ManyToOne(targetEntity="Membre")
     */
    private $Membre;

    /**
     * @return mixed
     */
    public function getAnnonce()
    {
        return $this->Annonce;
    }

    /**
     * @param mixed $Annonce
     */
    public function setAnnonce($Annonce)
    {
        $this->Annonce = $Annonce;
    }

    /**
     * @return mixed
     */
    public function getMembre()
    {
        return $this->Membre;
    }

    /**
     * @param mixed $Membre
     */
    public function setMembre($Membre)
    {
        $this->Membre = $Membre;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return notifications
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set message
     *
     * @param string $message
     *
     * @return notifications
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }
}


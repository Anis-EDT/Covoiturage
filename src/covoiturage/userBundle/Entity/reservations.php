<?php

namespace covoiturage\userBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * reservations
 *
 * @ORM\Table(name="reservations")
 * @ORM\Entity(repositoryClass="covoiturage\userBundle\Repository\reservationsRepository")
 */
class reservations
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
     * @ORM\Column(name="date_reservation", type="date")
     */
    private $dateReservation;
    /**
     * @ORM\ManyToOne(targetEntity="annonce")
     */
    private $Annonce;
    /**
     * @ORM\Column(name="nbplace", type="integer")
     */
    private $nbplace;

    /**
     * @return mixed
     */
    public function getNbplace()
    {
        return $this->nbplace;
    }

    /**
     * @param mixed $nbplace
     */
    public function setNbplace($nbplace)
    {
        $this->nbplace = $nbplace;
    }
    /**
     * @ORM\ManyToOne(targetEntity="Membre")
     */
    private $Chauffeur;
    /**
     * @ORM\ManyToOne(targetEntity="Membre")
     */
    private $passager1;
    /**
     * @ORM\ManyToOne(targetEntity="Membre")
     */
    private $passager2;
    /**
     * @ORM\ManyToOne(targetEntity="Membre")
     */
    private $passager3;
    /**
     * @ORM\ManyToOne(targetEntity="Membre")
     */
    private $passager4;

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
    public function getChauffeur()
    {
        return $this->Chauffeur;
    }

    /**
     * @param mixed $Chauffeur
     */
    public function setChauffeur($Chauffeur)
    {
        $this->Chauffeur = $Chauffeur;
    }

    /**
     * @return mixed
     */
    public function getPassager1()
    {
        return $this->passager1;
    }

    /**
     * @param mixed $passager1
     */
    public function setPassager1($passager1)
    {
        $this->passager1 = $passager1;
    }

    /**
     * @return mixed
     */
    public function getPassager2()
    {
        return $this->passager2;
    }

    /**
     * @param mixed $passager2
     */
    public function setPassager2($passager2)
    {
        $this->passager2 = $passager2;
    }

    /**
     * @return mixed
     */
    public function getPassager3()
    {
        return $this->passager3;
    }

    /**
     * @param mixed $passager3
     */
    public function setPassager3($passager3)
    {
        $this->passager3 = $passager3;
    }

    /**
     * @return mixed
     */
    public function getPassager4()
    {
        return $this->passager4;
    }

    /**
     * @param mixed $passager4
     */
    public function setPassager4($passager4)
    {
        $this->passager4 = $passager4;
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
     * Set dateReservation
     *
     * @param \DateTime $dateReservation
     *
     * @return reservations
     */
    public function setDateReservation($dateReservation)
    {
        $this->dateReservation = $dateReservation;

        return $this;
    }

    /**
     * Get dateReservation
     *
     * @return \DateTime
     */
    public function getDateReservation()
    {
        return $this->dateReservation;
    }
}


<?php

namespace covoiturage\userBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * annonce
 *
 * @ORM\Table(name="annonce")
 * @ORM\Entity(repositoryClass="covoiturage\userBundle\Repository\annonceRepository")
 */
class annonce
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
     * @var \DateTime
     *
     * @ORM\Column(name="date_depart", type="datetime")
     */
    private $date_depart;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="heure_depart", type="time")
     */
    private $heure_depart;
    /**
     * @var string
     *
     * @ORM\Column(name="commentaire", type="string", length=255)
     */
    private $commentaire;
    /**
     * @var int
     *
     * @ORM\Column(name="nb_places", type="integer")
     */
    private $nb_places;
    /**
     * @var int
     *
     * @ORM\Column(name="rating", type="integer", nullable=true)
     */
    private $rating;
    /**
     * @var int
     *
     * @ORM\Column(name="nbrrate", type="integer", nullable=true)
     */
    private $nbrrate;

    /**
     * @return int
     */
    public function getNbrrate()
    {
        return $this->nbrrate;
    }

    /**
     * @param int $nbrrate
     */
    public function setNbrrate($nbrrate)
    {
        $this->nbrrate = $nbrrate;
    }

    /**
     * @return int
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * @param int $rating
     */
    public function setRating($rating)
    {
        $this->rating = $rating;
    }

    /**
     * @return int
     */
    public function getNbPlaces()
    {
        return $this->nb_places;
    }

    /**
     * @param int $nb_places
     */
    public function setNbPlaces($nb_places)
    {
        $this->nb_places = $nb_places;
    }

    /**
     * @return \DateTime
     */
    public function getDateDepart()
    {
        return $this->date_depart;
    }

    /**
     * @param \DateTime $date_depart
     */
    public function setDateDepart($date_depart)
    {
        $this->date_depart = $date_depart;
    }

    /**
     * @return mixed
     */
    public function getHeureDepart()
    {
        return $this->heure_depart;
    }

    /**
     * @param mixed $heure_depart
     */
    public function setHeureDepart($heure_depart)
    {
        $this->heure_depart = $heure_depart;
    }

    /**
     * @return mixed
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }

    /**
     * @param mixed $commentaire
     */
    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;
    }

    /**
     * @var float
     *
     * @ORM\Column(name="prix", type="float")
     */
    private $prix;

    /**
     * @var string
     *
     * @ORM\Column(name="deviation", type="string", length=255)
     */
    private $deviation;
    /**
     * @ORM\ManyToOne(targetEntity="Membre")
     */
    private $Membre;
    /**
     * @ORM\ManyToOne(targetEntity="trajet")
     */
    private $trajet;

    /**
     * @return mixed
     */
    public function getTrajet()
    {
        return $this->trajet;
    }

    /**
     * @param mixed $trajet
     */
    public function setTrajet($trajet)
    {
        $this->trajet = $trajet;
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
     * @return annonce
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
     * Set prix
     *
     * @param float $prix
     *
     * @return annonce
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return float
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set deviation
     *
     * @param string $deviation
     *
     * @return annonce
     */
    public function setDeviation($deviation)
    {
        $this->deviation = $deviation;

        return $this;
    }

    /**
     * Get deviation
     *
     * @return string
     */
    public function getDeviation()
    {
        return $this->deviation;
    }
}


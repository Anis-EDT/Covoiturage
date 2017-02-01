<?php

namespace covoiturage\userBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * Membre
 *
 * @ORM\Table(name="membre")
 * @ORM\Entity(repositoryClass="covoiturage\userBundle\Repository\MembreRepository")
 */
class Membre extends BaseUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;



    /**
     * @var string
     *
     * @ORM\Column(name="photo_membre", type="string", length=255, nullable=true)
     */
    private $photoMembre;

    /**
     * @var string
     *
     * @ORM\Column(name="sexe", type="string", length=255, nullable=true)
     */
    private $sexe;

    /**
     * @var bool
     *
     * @ORM\Column(name="tabagisme", type="boolean", nullable=true)
     */
    private $tabagisme;

    /**
     * @var string
     *
     * @ORM\Column(name="musique", type="string", length=255, nullable=true)
     */
    private $musique;

    /**
     * @var bool
     *
     * @ORM\Column(name="animaux", type="boolean", nullable=true)
     */
    private $animaux;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255, nullable=true)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255, nullable=true)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="telephone", type="string", length=255, nullable=true)
     */
    private $telephone;

    /**
     * @var string
     *
     * @ORM\Column(name="premis_conduite", type="string", length=255, nullable=true)
     */
    private $premisConduite;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getPhotoMembre()
    {
        return $this->photoMembre;
    }

    /**
     * @param string $photoMembre
     */
    public function setPhotoMembre($photoMembre)
    {
        $this->photoMembre = $photoMembre;
    }

    /**
     * @return string
     */
    public function getSexe()
    {
        return $this->sexe;
    }

    /**
     * @param string $sexe
     */
    public function setSexe($sexe)
    {
        $this->sexe = $sexe;
    }

    /**
     * @return boolean
     */
    public function isTabagisme()
    {
        return $this->tabagisme;
    }

    /**
     * @param boolean $tabagisme
     */
    public function setTabagisme($tabagisme)
    {
        $this->tabagisme = $tabagisme;
    }

    /**
     * @return string
     */
    public function getMusique()
    {
        return $this->musique;
    }

    /**
     * @param string $musique
     */
    public function setMusique($musique)
    {
        $this->musique = $musique;
    }

    /**
     * @return boolean
     */
    public function isAnimaux()
    {
        return $this->animaux;
    }

    /**
     * @param boolean $animaux
     */
    public function setAnimaux($animaux)
    {
        $this->animaux = $animaux;
    }

    /**
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param string $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    /**
     * @return string
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * @param string $telephone
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;
    }

    /**
     * @return string
     */
    public function getPremisConduite()
    {
        return $this->premisConduite;
    }

    /**
     * @param string $premisConduite
     */
    public function setPremisConduite($premisConduite)
    {
        $this->premisConduite = $premisConduite;
    }


}


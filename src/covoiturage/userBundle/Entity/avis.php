<?php

namespace covoiturage\userBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * avis
 *
 * @ORM\Table(name="avis")
 * @ORM\Entity(repositoryClass="covoiturage\userBundle\Repository\avisRepository")
 */
class avis
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
     * @var string
     *
     * @ORM\Column(name="commentaire", type="string", length=255)
     */
    private $commentaire;

    /**
     * @var float
     *
     * @ORM\Column(name="note", type="float")
     */
    private $note;
    /**
     * @ORM\ManyToOne(targetEntity="Membre")
     */
    private $Membre;
    /**
     * @ORM\ManyToOne(targetEntity="annonce")
     */
    private $Annonce;

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
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set commentaire
     *
     * @param string $commentaire
     *
     * @return avis
     */
    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    /**
     * Get commentaire
     *
     * @return string
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }

    /**
     * Set note
     *
     * @param float $note
     *
     * @return avis
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note
     *
     * @return float
     */
    public function getNote()
    {
        return $this->note;
    }
}


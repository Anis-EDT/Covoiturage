<?php

namespace covoiturage\userBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * trajet
 *
 * @ORM\Table(name="trajet")
 * @ORM\Entity(repositoryClass="covoiturage\userBundle\Repository\trajetRepository")
 */
class trajet
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
     * @var float
     *
     * @ORM\Column(name="distance", type="float")
     */
    private $distance;
    /**
     * @ORM\ManyToOne(targetEntity="ville")
     */
    private $ville_depart;
    /**
     * @ORM\ManyToOne(targetEntity="ville")
     */
    private $ville_arrive;
    /**
     * @var string
     *
     * @ORM\Column(name="escale", type="string", length=255)
     */
    private $escale;

    /**
     * @return mixed
     */
    public function getVilleDepart()
    {
        return $this->ville_depart;
    }

    /**
     * @param mixed $ville_depart
     */
    public function setVilleDepart($ville_depart)
    {
        $this->ville_depart = $ville_depart;
    }

    /**
     * @return mixed
     */
    public function getVilleArrive()
    {
        return $this->ville_arrive;
    }

    /**
     * @param mixed $ville_arrive
     */
    public function setVilleArrive($ville_arrive)
    {
        $this->ville_arrive = $ville_arrive;
    }

    /**
     * @return mixed
     */
    public function getEscale()
    {
        return $this->escale;
    }

    /**
     * @param mixed $escale
     */
    public function setEscale($escale)
    {
        $this->escale = $escale;
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
     * Set distance
     *
     * @param float $distance
     *
     * @return trajet
     */
    public function setDistance($distance)
    {
        $this->distance = $distance;

        return $this;
    }

    /**
     * Get distance
     *
     * @return float
     */
    public function getDistance()
    {
        return $this->distance;
    }
}


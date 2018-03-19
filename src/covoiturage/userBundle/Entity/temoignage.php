<?php
/**
 * Created by PhpStorm.
 * User: adel
 * Date: 04/02/2017
 * Time: 21:05
 */

namespace covoiturage\userBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
* temoignage
*
 * @ORM\Table(name="temoignage")
* @ORM\Entity()
*/

class temoignage
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
     * @ORM\Column(name="message", type="string", length=255)
     */
    private $message;
    /**
     * @ORM\ManyToOne(targetEntity="Membre")
     */
    private $Membre;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_tem", type="date")
     */
    private $date_tem;

    /**
     * @return \DateTime
     */
    public function getDateTem()
    {
        return $this->date_tem;
    }

    /**
     * @param \DateTime $date_tem
     */
    public function setDateTem($date_tem)
    {
        $this->date_tem = $date_tem;
    }

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
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param string $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
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

}
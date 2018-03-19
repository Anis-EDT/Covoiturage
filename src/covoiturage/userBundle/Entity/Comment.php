<?php
/**
 * Created by PhpStorm.
 * User: AH Info
 * Date: 15/02/2017
 * Time: 00:00
 */

namespace covoiturage\userBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\CommentBundle\Entity\Comment as BaseComment;

/**
 * @ORM\Entity
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 */
class Comment extends BaseComment
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * Thread of this comment
     *
     * @var Thread
     * @ORM\ManyToOne(targetEntity="covoiturage\userBundle\Entity\Thread")
     */
    protected $thread;
    /**
     * @ORM\ManyToOne(targetEntity="Membre")
     */
    protected $Membre;

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
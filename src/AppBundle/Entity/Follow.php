<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Follow
 *
 * @ORM\Table(name="follow")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FollowRepository")
 */
class Follow
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
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     */
    private $follower;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     */
    private $followed;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set follower
     *
     * @param User $follower
     *
     * @return Follow
     */
    public function setFollower(User $follower = null)
    {
        $this->follower = $follower;

        return $this;
    }

    /**
     * Get follower
     *
     * @return User
     */
    public function getFollower()
    {
        return $this->follower;
    }

    /**
     * Set followed
     *
     * @param User $followed
     *
     * @return Follow
     */
    public function setFollowed(User $followed = null)
    {
        $this->followed = $followed;

        return $this;
    }

    /**
     * Get followed
     *
     * @return User
     */
    public function getFollowed()
    {
        return $this->followed;
    }
}

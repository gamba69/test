<?php
/**
 * User: idulevich
 */

namespace TestTaskBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Account
 *
 * @ORM\Table("accounts")
 * @ORM\Entity(repositoryClass="TestTaskBundle\Repository\AccountRepository")
 * @ORM\HasLifecycleCallbacks()
 *
 * @package TestTaskBundle\Entity
 */
class Account
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="account", type="bigint", nullable=false)
     */
    private $account;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="added", type="datetime", nullable=false)
     */
    private $added;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="accounts")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $account
     */
    public function setAccount($account)
    {
        $this->account = $account;
    }

    /**
     * @return int
     */
    public function getAccount()
    {
        return $this->account;
    }

    /**
     * @param \DateTime $added
     */
    public function setAdded($added)
    {
        $this->added = $added;
    }

    /**
     * @return \DateTime
     */
    public function getAdded()
    {
        return $this->added;
    }

    /** @ORM\PrePersist() */
    public function onPrePersist()
    {
        $this->added = new \DateTime();
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }
}
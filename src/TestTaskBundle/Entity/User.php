<?php
/**
 * User: idulevich
 */

namespace TestTaskBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class User
 *
 * @ORM\Table("users")
 * @ORM\Entity(repositoryClass="TestTaskBundle\Repository\UserRepository")
 *
 * @package TestTaskBundle\Entity
 */
class User
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
     * @var string
     *
     * @ORM\Column(name="usr_name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="usr_email", type="string", length=255, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="usr_address", type="string", length=255, nullable=false)
     */
    private $address;

    /**
     * @var Account[]
     *
     * @ORM\OneToMany(targetEntity="Account", mappedBy="user", cascade={"persist", "remove"})
     */
    private $accounts;

    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->accounts = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param Account[] $accounts
     */
    public function setAccounts($accounts)
    {
        $this->accounts = $accounts;
    }

    /**
     * @return Account[]
     */
    public function getAccounts()
    {
        return $this->accounts;
    }
}

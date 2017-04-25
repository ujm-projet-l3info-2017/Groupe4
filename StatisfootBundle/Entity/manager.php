<?php

namespace Projet\StatisfootBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * manager
 *
 * @ORM\Table(name="manager")
 * @ORM\Entity(repositoryClass="Projet\StatisfootBundle\Repository\managerRepository")
 */
class manager implements UserInterface
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
     * @ORM\Column(name="nom_manag", type="string", length=40)
     */
    private $nomManag;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom_manag", type="string", length=40)
     */
    private $prenomManag;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=255, unique=true)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="text")
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="salt", type="string", length=255)
     */
    private $salt;

    /**
     * @var array
     *
     * @ORM\Column(name="roles", type="array")
     */
    private $roles;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=40)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="num_tel", type="string", length=12)
     */
    private $numTel;

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
     * Set nomManag
     *
     * @param string $nomManag
     *
     * @return manager
     */
    public function setNomManag($nomManag)
    {
        $this->nomManag = $nomManag;

        return $this;
    }

    /**
     * Get nomManag
     *
     * @return string
     */
    public function getNomManag()
    {
        return $this->nomManag;
    }

    /**
     * Set prenomManag
     *
     * @param string $prenomManag
     *
     * @return manager
     */
    public function setPrenomManag($prenomManag)
    {
        $this->prenomManag = $prenomManag;

        return $this;
    }

    /**
     * Get prenomManag
     *
     * @return string
     */
    public function getPrenomManag()
    {
        return $this->prenomManag;
    }


    /**
     * Set email
     *
     * @param string $email
     *
     * @return manager
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set username
     *
     * @param string $username
     *
     * @return manager
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return manager
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set salt
     *
     * @param string $salt
     *
     * @return manager
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * Get salt
     *
     * @return string
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * Set roles
     *
     * @param array $roles
     *
     * @return manager
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * Get roles
     *
     * @return array
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * Set numTel
     *
     * @param string $numTel
     *
     * @return manager
     */
    public function setNumTel($numTel)
    {
        $this->numTel = $numTel;

        return $this;
    }

    /**
     * Get numTel
     *
     * @return string
     */
    public function getNumTel()
    {
        return $this->numTel;
    }

    public function eraseCredentials(){

    }
}

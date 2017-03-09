<?php

namespace Projet\StatisfootBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * manager
 *
 * @ORM\Table(name="manager")
 * @ORM\Entity(repositoryClass="Projet\StatisfootBundle\Repository\managerRepository")
 */
class manager
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
     * @ORM\Column(name="pseudo", type="string", length=10)
     */
    private $pseudo;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=40)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="mdp", type="text")
     */
    private $mdp;

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
     * Set pseudo
     *
     * @param string $pseudo
     *
     * @return manager
     */
    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    /**
     * Get pseudo
     *
     * @return string
     */
    public function getPseudo()
    {
        return $this->pseudo;
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
     * Set mdp
     *
     * @param string $mdp
     *
     * @return manager
     */
    public function setMdp($mdp)
    {
        $this->mdp = $mdp;

        return $this;
    }

    /**
     * Get mdp
     *
     * @return string
     */
    public function getMdp()
    {
        return $this->mdp;
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
}


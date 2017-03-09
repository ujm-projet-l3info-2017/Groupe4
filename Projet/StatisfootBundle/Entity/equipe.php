<?php

namespace Projet\StatisfootBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * equipe
 *
 * @ORM\Table(name="equipe")
 * @ORM\Entity(repositoryClass="Projet\StatisfootBundle\Repository\equipeRepository")
 */
class equipe
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
     * @ORM\Column(name="nom", type="string", length=40)
     */
    private $nom;

    /**
    * @ORM\ManyToOne(targetEntity="Projet\StatisfootBundle\Entity\club")
    * @ORM\JoinColumn(nullable=false)
    */
    private $club;

    /**
    * @ORM\ManyToOne(targetEntity="Projet\StatisfootBundle\Entity\niveau")
    * @ORM\JoinColumn(nullable=false)
    */
    private $niveau;

    /**
    * @ORM\ManyToOne(targetEntity="Projet\StatisfootBundle\Entity\syst_jeu_def")
    * @ORM\JoinColumn(nullable=false)
    */
    private $systeme;

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
     * Set nom
     *
     * @param string $nom
     *
     * @return equipe
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set club
     *
     * @param \Projet\StatisfootBundle\Entity\club $club
     *
     * @return equipe
     */
    public function setClub(\Projet\StatisfootBundle\Entity\club $club)
    {
        $this->club = $club;

        return $this;
    }

    /**
     * Get club
     *
     * @return \Projet\StatisfootBundle\Entity\club
     */
    public function getClub()
    {
        return $this->club;
    }

    /**
     * Set niveau
     *
     * @param \Projet\StatisfootBundle\Entity\niveau $niveau
     *
     * @return equipe
     */
    public function setNiveau(\Projet\StatisfootBundle\Entity\niveau $niveau)
    {
        $this->niveau = $niveau;

        return $this;
    }

    /**
     * Get niveau
     *
     * @return \Projet\StatisfootBundle\Entity\niveau
     */
    public function getNiveau()
    {
        return $this->niveau;
    }
}

<?php

namespace Projet\StatisfootBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * equipe_manager
 *
 * @ORM\Table(name="equipe_manager")
 * @ORM\Entity(repositoryClass="Projet\StatisfootBundle\Repository\equipe_managerRepository")
 */
class equipe_manager
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
     * @var \DateTime
     *
     * @ORM\Column(name="date_debut", type="date")
     */
    private $dateDebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_fin", type="date")
     */
    private $dateFin;

     /**
    * @ORM\ManyToOne(targetEntity="Projet\StatisfootBundle\Entity\manager")
    * @ORM\JoinColumn(nullable=false)
    */
    private $manager;

    /**
    * @ORM\ManyToOne(targetEntity="Projet\StatisfootBundle\Entity\equipe")
    * @ORM\JoinColumn(nullable=false)
    */
    private $equipe;


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
     * Set dateDebut
     *
     * @param \DateTime $dateDebut
     *
     * @return equipe_manager
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    /**
     * Get dateDebut
     *
     * @return \DateTime
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * Set dateFin
     *
     * @param \DateTime $dateFin
     *
     * @return equipe_manager
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    /**
     * Get dateFin
     *
     * @return \DateTime
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }

    /**
     * Set manager
     *
     * @param \Projet\StatisfootBundle\Entity\manager $manager
     *
     * @return equipe_manager
     */
    public function setManager(\Projet\StatisfootBundle\Entity\manager $manager)
    {
        $this->manager = $manager;

        return $this;
    }

    /**
     * Get manager
     *
     * @return \Projet\StatisfootBundle\Entity\manager
     */
    public function getManager()
    {
        return $this->manager;
    }

    /**
     * Set equipe
     *
     * @param \Projet\StatisfootBundle\Entity\equipe $equipe
     *
     * @return equipe_manager
     */
    public function setEquipe(\Projet\StatisfootBundle\Entity\equipe $equipe)
    {
        $this->equipe = $equipe;

        return $this;
    }

    /**
     * Get equipe
     *
     * @return \Projet\StatisfootBundle\Entity\equipe
     */
    public function getEquipe()
    {
        return $this->equipe;
    }
}

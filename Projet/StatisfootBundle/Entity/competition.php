<?php

namespace Projet\StatisfootBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * competition
 *
 * @ORM\Table(name="competition")
 * @ORM\Entity(repositoryClass="Projet\StatisfootBundle\Repository\competitionRepository")
 */
class competition
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
     * @ORM\Column(name="nom_compet", type="string", length=40)
     */
    private $nomCompet;

    /**
     * @var string
     *
     * @ORM\Column(name="saison", type="string", length=10)
     */
    private $saison;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_deb", type="date")
     */
    private $dateDeb;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_fin", type="date")
     */
    private $dateFin;


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
     * Set idCompet
     *
     * @param string $idCompet
     *
     * @return competition
     */
    public function setIdCompet($idCompet)
    {
        $this->idCompet = $idCompet;

        return $this;
    }

    /**
     * Get idCompet
     *
     * @return string
     */
    public function getIdCompet()
    {
        return $this->idCompet;
    }

    /**
     * Set nomCompet
     *
     * @param string $nomCompet
     *
     * @return competition
     */
    public function setNomCompet($nomCompet)
    {
        $this->nomCompet = $nomCompet;

        return $this;
    }

    /**
     * Get nomCompet
     *
     * @return string
     */
    public function getNomCompet()
    {
        return $this->nomCompet;
    }

    /**
     * Set saison
     *
     * @param string $saison
     *
     * @return competition
     */
    public function setSaison($saison)
    {
        $this->saison = $saison;

        return $this;
    }

    /**
     * Get saison
     *
     * @return string
     */
    public function getSaison()
    {
        return $this->saison;
    }

    /**
     * Set dateDeb
     *
     * @param \DateTime $dateDeb
     *
     * @return competition
     */
    public function setDateDeb($dateDeb)
    {
        $this->dateDeb = $dateDeb;

        return $this;
    }

    /**
     * Get dateDeb
     *
     * @return \DateTime
     */
    public function getDateDeb()
    {
        return $this->dateDeb;
    }

    /**
     * Set dateFin
     *
     * @param \DateTime $dateFin
     *
     * @return competition
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
}


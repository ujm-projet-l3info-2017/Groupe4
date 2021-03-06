<?php

namespace Projet\StatisfootBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * joueur
 *
 * @ORM\Table(name="joueur")
 * @ORM\Entity(repositoryClass="Projet\StatisfootBundle\Repository\joueurRepository")
 */
class joueur
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
     * @ORM\Column(name="nom_j", type="string", length=40)
     */
    private $nomJ;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom_j", type="string", length=40)
     */
    private $prenomJ;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_naiss", type="date")
     */
    private $dateNaiss;

    /**
    * @ORM\ManyToOne(targetEntity="Projet\StatisfootBundle\Entity\poste")
    * @ORM\JoinColumn(nullable=false)
    */
    private $poste;

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
     * Set nomJ
     *
     * @param string $nomJ
     *
     * @return joueur
     */
    public function setNomJ($nomJ)
    {
        $this->nomJ = $nomJ;

        return $this;
    }

    /**
     * Get nomJ
     *
     * @return string
     */
    public function getNomJ()
    {
        return $this->nomJ;
    }

    /**
     * Set prenomJ
     *
     * @param string $prenomJ
     *
     * @return joueur
     */
    public function setPrenomJ($prenomJ)
    {
        $this->prenomJ = $prenomJ;

        return $this;
    }

    /**
     * Get prenomJ
     *
     * @return string
     */
    public function getPrenomJ()
    {
        return $this->prenomJ;
    }

    /**
     * Set dateNaiss
     *
     * @param \DateTime $dateNaiss
     *
     * @return joueur
     */
    public function setDateNaiss($dateNaiss)
    {
        $this->dateNaiss = $dateNaiss;

        return $this;
    }

    /**
     * Get dateNaiss
     *
     * @return \DateTime
     */
    public function getDateNaiss()
    {
        return $this->dateNaiss;
    }

    /**
     * Set poste
     *
     * @param \Projet\StatisfootBundle\Entity\poste $poste
     *
     * @return joueur
     */
    public function setPoste(\Projet\StatisfootBundle\Entity\poste $poste)
    {
        $this->poste = $poste;

        return $this;
    }

    /**
     * Get poste
     *
     * @return \Projet\StatisfootBundle\Entity\poste
     */
    public function getPoste()
    {
        return $this->poste;
    }
}

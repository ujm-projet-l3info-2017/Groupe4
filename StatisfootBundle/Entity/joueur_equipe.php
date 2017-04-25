<?php

namespace Projet\StatisfootBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * joueur_equipe
 *
 * @ORM\Table(name="joueur_equipe")
 * @ORM\Entity(repositoryClass="Projet\StatisfootBundle\Repository\joueur_equipeRepository")
 */
class joueur_equipe
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
     * @ORM\Column(name="poste", type="string", length=10)
     */
    private $poste;

    /**
     * @var bool
     *
     * @ORM\Column(name="titulaire", type="boolean")
     */
    private $titulaire;

    /**
     * @var bool
     *
     * @ORM\Column(name="remplacant", type="boolean")
     */
    private $remplacant;

    /**
    * @var date
    *
    * @ORM\Column(name="date_debut", type="date")
    */
    private $date_debut;

    /**
    * @var date
    *
    * @ORM\Column(name="date_fin", type="date")
    */
    private $date_fin;


    /**
    * @ORM\ManyToOne(targetEntity="Projet\StatisfootBundle\Entity\joueur")
    * @ORM\JoinColumn(nullable=false)
    */
    private $joueur;

    /**
    * @ORM\ManyToOne(targetEntity="Projet\StatisfootBundle\Entity\equipe")
    * @ORM\JoinColumn(nullable=false)
    */
    private $equipe;

    public function __construct(){
        $this->date_debut = new \DateTime();
        $this->date_fin = date("Y-m-d",strtotime("+10 year", new DateTime()));
        $this->titulaire = false;
        $this->remplacant = true;
    }

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
     * Set poste
     *
     * @param string $poste
     *
     * @return joueur_equipe
     */
    public function setPoste($poste)
    {
        $this->poste = $poste;

        return $this;
    }

    /**
     * Get poste
     *
     * @return string
     */
    public function getPoste()
    {
        return $this->poste;
    }

    /**
     * Set titulaire
     *
     * @param boolean $titulaire
     *
     * @return joueur_equipe
     */
    public function setTitulaire($titulaire)
    {
        $this->titulaire = $titulaire;

        return $this;
    }

    /**
     * Get titulaire
     *
     * @return bool
     */
    public function getTitulaire()
    {
        return $this->titulaire;
    }

    /**
     * Set remplacant
     *
     * @param boolean $remplacant
     *
     * @return joueur_equipe
     */
    public function setRemplacant($remplacant)
    {
        $this->remplacant = $remplacant;

        return $this;
    }

    /**
     * Get remplacant
     *
     * @return bool
     */
    public function getRemplacant()
    {
        return $this->remplacant;
    }

    /**
     * Set joueur
     *
     * @param \Projet\StatisfootBundle\Entity\joueur $joueur
     *
     * @return joueur_equipe
     */
    public function setJoueur(\Projet\StatisfootBundle\Entity\joueur $joueur)
    {
        $this->joueur = $joueur;

        return $this;
    }

    /**
     * Get joueur
     *
     * @return \Projet\StatisfootBundle\Entity\joueur
     */
    public function getJoueur()
    {
        return $this->joueur;
    }

    /**
     * Set equipe
     *
     * @param \Projet\StatisfootBundle\Entity\equipe $equipe
     *
     * @return joueur_equipe
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

    /**
     * Set dateDebut
     *
     * @param \DateTime $dateDebut
     *
     * @return joueur_equipe
     */
    public function setDateDebut($dateDebut)
    {
        $this->date_debut = $dateDebut;

        return $this;
    }

    /**
     * Get dateDebut
     *
     * @return \DateTime
     */
    public function getDateDebut()
    {
        return $this->date_debut;
    }

    /**
     * Set dateFin
     *
     * @param \DateTime $dateFin
     *
     * @return joueur_equipe
     */
    public function setDateFin($dateFin)
    {
        $this->date_fin = $dateFin;

        return $this;
    }

    /**
     * Get dateFin
     *
     * @return \DateTime
     */
    public function getDateFin()
    {
        return $this->date_fin;
    }
}

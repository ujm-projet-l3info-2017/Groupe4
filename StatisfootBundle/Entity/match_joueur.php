<?php

namespace Projet\StatisfootBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * match_joueur
 *
 * @ORM\Table(name="match_joueur")
 * @ORM\Entity(repositoryClass="Projet\StatisfootBundle\Repository\match_joueurRepository")
 */
class match_joueur
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
     * @var int
     *
     * @ORM\Column(name="min_entre", type="integer")
     */
    private $minEntre;

    /**
     * @var int
     *
     * @ORM\Column(name="min_sortie", type="integer")
     */
    private $minSortie;

    /**
     * @var int
     *
     * @ORM\Column(name="nb_duel_gagne", type="integer")
     */
    private $nbDuelGagne;

    /**
     * @var int
     *
     * @ORM\Column(name="nb_balle_inter", type="integer")
     */
    private $nbBalleInter;

    /**
     * @var int
     *
     * @ORM\Column(name="nb_balle_recup", type="integer")
     */
    private $nbBalleRecup;

    /**
     * @var int
     *
     * @ORM\Column(name="nb_balle_arret", type="integer")
     */
    private $nbBalleArret;

    /**
     * @var int
     *
     * @ORM\Column(name="nb_centre", type="integer")
     */
    private $nbCentre;

    /**
     * @var int
     *
     * @ORM\Column(name="nb_tacle", type="integer")
     */
    private $nbTacle;

    /**
     * @var boolean
     *
     * @ORM\Column(name="carton_rouge", type="boolean")
     */
    private $carton_rouge;

    /**
     * @var int
     *
     * @ORM\Column(name="carton_jaune", type="integer")
     */
    private $carton_jaune;

    /**
    * @ORM\ManyToOne(targetEntity="Projet\StatisfootBundle\Entity\joueur")
    * @ORM\JoinColumn(nullable=false)
    */
     private $joueur;

    /**
    * @ORM\ManyToOne(targetEntity="Projet\StatisfootBundle\Entity\match_foot")
    * @ORM\JoinColumn(nullable=false)
    */

    private $match_foot;

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
     * @return match_joueur
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
     * Set minEntre
     *
     * @param integer $minEntre
     *
     * @return match_joueur
     */
    public function setMinEntre($minEntre)
    {
        $this->minEntre = $minEntre;

        return $this;
    }

    /**
     * Get minEntre
     *
     * @return int
     */
    public function getMinEntre()
    {
        return $this->minEntre;
    }

    /**
     * Set minSortie
     *
     * @param integer $minSortie
     *
     * @return match_joueur
     */
    public function setMinSortie($minSortie)
    {
        $this->minSortie = $minSortie;

        return $this;
    }

    /**
     * Get minSortie
     *
     * @return int
     */
    public function getMinSortie()
    {
        return $this->minSortie;
    }

    /**
     * Set nbDuelGagne
     *
     * @param integer $nbDuelGagne
     *
     * @return match_joueur
     */
    public function setNbDuelGagne($nbDuelGagne)
    {
        $this->nbDuelGagne = $nbDuelGagne;

        return $this;
    }

    /**
     * Get nbDuelGagne
     *
     * @return int
     */
    public function getNbDuelGagne()
    {
        return $this->nbDuelGagne;
    }

    /**
     * Set nbBalleInter
     *
     * @param integer $nbBalleInter
     *
     * @return match_joueur
     */
    public function setNbBalleInter($nbBalleInter)
    {
        $this->nbBalleInter = $nbBalleInter;

        return $this;
    }

    /**
     * Get nbBalleInter
     *
     * @return int
     */
    public function getNbBalleInter()
    {
        return $this->nbBalleInter;
    }

    /**
     * Set nbBalleRecup
     *
     * @param integer $nbBalleRecup
     *
     * @return match_joueur
     */
    public function setNbBalleRecup($nbBalleRecup)
    {
        $this->nbBalleRecup = $nbBalleRecup;

        return $this;
    }

    /**
     * Get nbBalleRecup
     *
     * @return int
     */
    public function getNbBalleRecup()
    {
        return $this->nbBalleRecup;
    }

    /**
     * Set nbBalleArret
     *
     * @param integer $nbBalleArret
     *
     * @return match_joueur
     */
    public function setNbBalleArret($nbBalleArret)
    {
        $this->nbBalleArret = $nbBalleArret;

        return $this;
    }

    /**
     * Get nbBalleArret
     *
     * @return int
     */
    public function getNbBalleArret()
    {
        return $this->nbBalleArret;
    }

    /**
     * Set nbCentre
     *
     * @param integer $nbCentre
     *
     * @return match_joueur
     */
    public function setNbCentre($nbCentre)
    {
        $this->nbCentre = $nbCentre;

        return $this;
    }

    /**
     * Get nbCentre
     *
     * @return int
     */
    public function getNbCentre()
    {
        return $this->nbCentre;
    }

    /**
     * Set nbTacle
     *
     * @param integer $nbTacle
     *
     * @return match_joueur
     */
    public function setNbTacle($nbTacle)
    {
        $this->nbTacle = $nbTacle;

        return $this;
    }

    /**
     * Get nbTacle
     *
     * @return int
     */
    public function getNbTacle()
    {
        return $this->nbTacle;
    }

    /**
     * Set cartonRouge
     *
     * @param boolean $cartonRouge
     *
     * @return match_joueur
     */
    public function setCartonRouge($cartonRouge)
    {
        $this->carton_rouge = $cartonRouge;

        return $this;
    }

    /**
     * Get cartonRouge
     *
     * @return boolean
     */
    public function getCartonRouge()
    {
        return $this->carton_rouge;
    }

    /**
     * Set cartonJaune
     *
     * @param integer $cartonJaune
     *
     * @return match_joueur
     */
    public function setCartonJaune($cartonJaune)
    {
        $this->carton_jaune = $cartonJaune;

        return $this;
    }

    /**
     * Get cartonJaune
     *
     * @return integer
     */
    public function getCartonJaune()
    {
        return $this->carton_jaune;
    }

    /**
     * Set joueur
     *
     * @param \Projet\StatisfootBundle\Entity\joueur $joueur
     *
     * @return match_joueur
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
     * Set matchFoot
     *
     * @param \Projet\StatisfootBundle\Entity\match_foot $matchFoot
     *
     * @return match_joueur
     */
    public function setMatchFoot(\Projet\StatisfootBundle\Entity\match_foot $matchFoot)
    {
        $this->match_foot = $matchFoot;

        return $this;
    }

    /**
     * Get matchFoot
     *
     * @return \Projet\StatisfootBundle\Entity\match_foot
     */
    public function getMatchFoot()
    {
        return $this->match_foot;
    }
}

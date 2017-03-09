<?php

namespace Projet\StatisfootBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * but
 *
 * @ORM\Table(name="but")
 * @ORM\Entity(repositoryClass="Projet\StatisfootBundle\Repository\butRepository")
 */
class but
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
     * @var int
     *
     * @ORM\Column(name="min_jeu", type="integer")
     */
    private $minJeu;

    /**

    * @ORM\ManyToOne(targetEntity="Projet\StatisfootBundle\Entity\joueur")
    * @ORM\JoinColumn(nullable=false)
    */

    private $joueur;

    /**
    * @ORM\ManyToOne(targetEntity="Projet\StatisfootBundle\Entity\type_but")
    * @ORM\JoinColumn(nullable=false)
    */    
    private $type_but;

    /**
    * @ORM\ManyToOne(targetEntity="Projet\StatisfootBundle\Entity\type_action")
    * @ORM\JoinColumn(nullable=false)
    */
    private $type_action;

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
     * Set minJeu
     *
     * @param integer $minJeu
     *
     * @return but
     */
    public function setMinJeu($minJeu)
    {
        $this->minJeu = $minJeu;

        return $this;
    }

    /**
     * Get minJeu
     *
     * @return int
     */
    public function getMinJeu()
    {
        return $this->minJeu;
    }

    /**
     * Set joueur
     *
     * @param \Projet\StatisfootBundle\Entity\joueur $joueur
     *
     * @return but
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
     * Set typeBut
     *
     * @param \Projet\StatisfootBundle\Entity\type_but $typeBut
     *
     * @return but
     */
    public function setTypeBut(\Projet\StatisfootBundle\Entity\type_but $typeBut)
    {
        $this->type_but = $typeBut;

        return $this;
    }

    /**
     * Get typeBut
     *
     * @return \Projet\StatisfootBundle\Entity\type_but
     */
    public function getTypeBut()
    {
        return $this->type_but;
    }

    /**
     * Set typeAction
     *
     * @param \Projet\StatisfootBundle\Entity\type_action $typeAction
     *
     * @return but
     */
    public function setTypeAction(\Projet\StatisfootBundle\Entity\type_action $typeAction)
    {
        $this->type_action = $typeAction;

        return $this;
    }

    /**
     * Get typeAction
     *
     * @return \Projet\StatisfootBundle\Entity\type_action
     */
    public function getTypeAction()
    {
        return $this->type_action;
    }

    /**
     * Set matchFoot
     *
     * @param \Projet\StatisfootBundle\Entity\match_foot $matchFoot
     *
     * @return but
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

<?php

namespace Projet\StatisfootBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * passe_decisive
 *
 * @ORM\Table(name="passe_decisive")
 * @ORM\Entity(repositoryClass="Projet\StatisfootBundle\Repository\passe_decisiveRepository")
 */
class passe_decisive
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
     * @ORM\OneToOne(targetEntity="Projet\StatisfootBundle\Entity\but", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $but;

    /**
    * @ORM\ManyToOne(targetEntity="Projet\StatisfootBundle\Entity\joueur")
    * @ORM\JoinColumn(nullable=false)
    */
    private $joueur;

    /**
    * @ORM\ManyToOne(targetEntity="Projet\StatisfootBundle\Entity\type_passe")
    * @ORM\JoinColumn(nullable=false)
    */
    private $type_passe;

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
     * Set but
     *
     * @param \Projet\StatisfootBundle\Entity\but $but
     *
     * @return passe_decisive
     */
    public function setBut(\Projet\StatisfootBundle\Entity\but $but)
    {
        $this->but = $but;

        return $this;
    }

    /**
     * Get but
     *
     * @return \Projet\StatisfootBundle\Entity\but
     */
    public function getBut()
    {
        return $this->but;
    }

    /**
     * Set joueur
     *
     * @param \Projet\StatisfootBundle\Entity\joueur $joueur
     *
     * @return passe_decisive
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
     * Set typePasse
     *
     * @param \Projet\StatisfootBundle\Entity\type_passe $typePasse
     *
     * @return passe_decisive
     */
    public function setTypePasse(\Projet\StatisfootBundle\Entity\type_passe $typePasse)
    {
        $this->type_passe = $typePasse;

        return $this;
    }

    /**
     * Get typePasse
     *
     * @return \Projet\StatisfootBundle\Entity\type_passe
     */
    public function getTypePasse()
    {
        return $this->type_passe;
    }
}

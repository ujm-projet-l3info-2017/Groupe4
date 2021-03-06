<?php

namespace Projet\StatisfootBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * match_equipe
 *
 * @ORM\Table(name="match_equipe")
 * @ORM\Entity(repositoryClass="Projet\StatisfootBundle\Repository\match_equipeRepository")
 */
class match_equipe
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
     * @ORM\Column(name="but_marq", type="integer")
     */
    private $butMarq;

    /**
     * @var int
     *
     * @ORM\Column(name="but_enc", type="integer")
     */
    private $butEnc;

    /**
     * @var int
     *
     * @ORM\Column(name="corner_obt", type="integer")
     */
    private $cornerObt;

    /**
     * @var int
     *
     * @ORM\Column(name="corner_conc", type="integer")
     */
    private $cornerConc;

    /**
     * @var int
     *
     * @ORM\Column(name="tir_cadre", type="integer")
     */
    private $tirCadre;

    /**
     * @var int
     *
     * @ORM\Column(name="cf_obt", type="integer")
     */
    private $cfObt;

    /**
     * @var int
     *
     * @ORM\Column(name="cf_conc", type="integer")
     */
    private $cfConc;

    /**
    * @ORM\ManyToOne(targetEntity="Projet\StatisfootBundle\Entity\equipe")
    * @ORM\JoinColumn(nullable=false)
    */
    private $equipe;

    /**
    * @ORM\ManyToOne(targetEntity="Projet\StatisfootBundle\Entity\match_foot")
    * @ORM\JoinColumn(nullable=false)
    */
    private $match;


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
     * Set butMarq
     *
     * @param integer $butMarq
     *
     * @return match_equipe
     */
    public function setButMarq($butMarq)
    {
        $this->butMarq = $butMarq;

        return $this;
    }

    /**
     * Get butMarq
     *
     * @return int
     */
    public function getButMarq()
    {
        return $this->butMarq;
    }

    /**
     * Set butEnc
     *
     * @param integer $butEnc
     *
     * @return match_equipe
     */
    public function setButEnc($butEnc)
    {
        $this->butEnc = $butEnc;

        return $this;
    }

    /**
     * Get butEnc
     *
     * @return int
     */
    public function getButEnc()
    {
        return $this->butEnc;
    }

    /**
     * Set cornerObt
     *
     * @param integer $cornerObt
     *
     * @return match_equipe
     */
    public function setCornerObt($cornerObt)
    {
        $this->cornerObt = $cornerObt;

        return $this;
    }

    /**
     * Get cornerObt
     *
     * @return int
     */
    public function getCornerObt()
    {
        return $this->cornerObt;
    }

    /**
     * Set cornerConc
     *
     * @param integer $cornerConc
     *
     * @return match_equipe
     */
    public function setCornerConc($cornerConc)
    {
        $this->cornerConc = $cornerConc;

        return $this;
    }

    /**
     * Get cornerConc
     *
     * @return int
     */
    public function getCornerConc()
    {
        return $this->cornerConc;
    }

    /**
     * Set tirCadre
     *
     * @param integer $tirCadre
     *
     * @return match_equipe
     */
    public function setTirCadre($tirCadre)
    {
        $this->tirCadre = $tirCadre;

        return $this;
    }

    /**
     * Get tirCadre
     *
     * @return int
     */
    public function getTirCadre()
    {
        return $this->tirCadre;
    }

    /**
     * Set cfObt
     *
     * @param integer $cfObt
     *
     * @return match_equipe
     */
    public function setCfObt($cfObt)
    {
        $this->cfObt = $cfObt;

        return $this;
    }

    /**
     * Get cfObt
     *
     * @return int
     */
    public function getCfObt()
    {
        return $this->cfObt;
    }

    /**
     * Set cfConc
     *
     * @param integer $cfConc
     *
     * @return match_equipe
     */
    public function setCfConc($cfConc)
    {
        $this->cfConc = $cfConc;

        return $this;
    }

    /**
     * Get cfConc
     *
     * @return int
     */
    public function getCfConc()
    {
        return $this->cfConc;
    }

    /**
     * Set equipe
     *
     * @param \Projet\StatisfootBundle\Entity\equipe $equipe
     *
     * @return match_equipe
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
     * Set match
     *
     * @param \Projet\StatisfootBundle\Entity\match_foot $match
     *
     * @return match_equipe
     */
    public function setMatch(\Projet\StatisfootBundle\Entity\match_foot $match)
    {
        $this->match = $match;

        return $this;
    }

    /**
     * Get match
     *
     * @return \Projet\StatisfootBundle\Entity\match_foot
     */
    public function getMatch()
    {
        return $this->match;
    }
}

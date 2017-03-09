<?php

namespace Projet\StatisfootBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * syst_jeu_def
 *
 * @ORM\Table(name="syst_jeu_def")
 * @ORM\Entity(repositoryClass="Projet\StatisfootBundle\Repository\syst_jeu_defRepository")
 */
class syst_jeu_def
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
     * @ORM\Column(name="libelle_syst", type="string", length=20)
     */
    private $libelleSyst;

    /**
     * @var string
     *
     * @ORM\Column(name="descrip_syst", type="text")
     */
    private $descripSyst;


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
     * Set libelleSyst
     *
     * @param string $libelleSyst
     *
     * @return syst_jeu_def
     */
    public function setLibelleSyst($libelleSyst)
    {
        $this->libelleSyst = $libelleSyst;

        return $this;
    }

    /**
     * Get libelleSyst
     *
     * @return string
     */
    public function getLibelleSyst()
    {
        return $this->libelleSyst;
    }

    /**
     * Set descripSyst
     *
     * @param string $descripSyst
     *
     * @return syst_jeu_def
     */
    public function setDescripSyst($descripSyst)
    {
        $this->descripSyst = $descripSyst;

        return $this;
    }

    /**
     * Get descripSyst
     *
     * @return string
     */
    public function getDescripSyst()
    {
        return $this->descripSyst;
    }
}


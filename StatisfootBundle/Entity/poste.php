<?php

namespace Projet\StatisfootBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * poste
 *
 * @ORM\Table(name="poste")
 * @ORM\Entity(repositoryClass="Projet\StatisfootBundle\Repository\posteRepository")
 */
class poste
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
     * @ORM\Column(name="libelle_poste", type="string", length=40)
     */
    private $libellePoste;

    /**
     * @var string
     *
     * @ORM\Column(name="descrip_poste", type="string", length=40)
     */
    private $descripPoste;


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
     * Set libellePoste
     *
     * @param string $libellePoste
     *
     * @return poste
     */
    public function setLibellePoste($libellePoste)
    {
        $this->libellePoste = $libellePoste;

        return $this;
    }

    /**
     * Get libellePoste
     *
     * @return string
     */
    public function getLibellePoste()
    {
        return $this->libellePoste;
    }

    /**
     * Set descripPoste
     *
     * @param string $descripPoste
     *
     * @return poste
     */
    public function setDescripPoste($descripPoste)
    {
        $this->descripPoste = $descripPoste;

        return $this;
    }

    /**
     * Get descripPoste
     *
     * @return string
     */
    public function getDescripPoste()
    {
        return $this->descripPoste;
    }
}


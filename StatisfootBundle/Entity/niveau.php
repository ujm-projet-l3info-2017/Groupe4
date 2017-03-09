<?php

namespace Projet\StatisfootBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * niveau
 *
 * @ORM\Table(name="niveau")
 * @ORM\Entity(repositoryClass="Projet\StatisfootBundle\Repository\niveauRepository")
 */
class niveau
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
     * @ORM\Column(name="libelle_niv", type="string", length=40)
     */
    private $libelleNiv;


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
     * Set libelleNiv
     *
     * @param string $libelleNiv
     *
     * @return niveau
     */
    public function setLibelleNiv($libelleNiv)
    {
        $this->libelleNiv = $libelleNiv;

        return $this;
    }

    /**
     * Get libelleNiv
     *
     * @return string
     */
    public function getLibelleNiv()
    {
        return $this->libelleNiv;
    }
}


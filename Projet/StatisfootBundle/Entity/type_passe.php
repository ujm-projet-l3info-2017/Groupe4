<?php

namespace Projet\StatisfootBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * type_passe
 *
 * @ORM\Table(name="type_passe")
 * @ORM\Entity(repositoryClass="Projet\StatisfootBundle\Repository\type_passeRepository")
 */
class type_passe
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
     * @ORM\Column(name="libelle_type_passe", type="string", length=40)
     */
    private $libelleTypePasse;


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
     * Set libelleTypePasse
     *
     * @param string $libelleTypePasse
     *
     * @return type_passe
     */
    public function setLibelleTypePasse($libelleTypePasse)
    {
        $this->libelleTypePasse = $libelleTypePasse;

        return $this;
    }

    /**
     * Get libelleTypePasse
     *
     * @return string
     */
    public function getLibelleTypePasse()
    {
        return $this->libelleTypePasse;
    }
}


<?php

namespace Projet\StatisfootBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * type_but
 *
 * @ORM\Table(name="type_but")
 * @ORM\Entity(repositoryClass="Projet\StatisfootBundle\Repository\type_butRepository")
 */
class type_but
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
     * @ORM\Column(name="libelle_type_but", type="string", length=40)
     */
    private $libelleTypeBut;


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
     * Set libelleTypeBut
     *
     * @param string $libelleTypeBut
     *
     * @return type_but
     */
    public function setLibelleTypeBut($libelleTypeBut)
    {
        $this->libelleTypeBut = $libelleTypeBut;

        return $this;
    }

    /**
     * Get libelleTypeBut
     *
     * @return string
     */
    public function getLibelleTypeBut()
    {
        return $this->libelleTypeBut;
    }
}


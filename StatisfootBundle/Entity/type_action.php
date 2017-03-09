<?php

namespace Projet\StatisfootBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * type_action
 *
 * @ORM\Table(name="type_action")
 * @ORM\Entity(repositoryClass="Projet\StatisfootBundle\Repository\type_actionRepository")
 */
class type_action
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
     * @ORM\Column(name="libelle_type_act", type="string", length=40)
     */
    private $libelleTypeAct;


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
     * Set libelleTypeAct
     *
     * @param string $libelleTypeAct
     *
     * @return type_action
     */
    public function setLibelleTypeAct($libelleTypeAct)
    {
        $this->libelleTypeAct = $libelleTypeAct;

        return $this;
    }

    /**
     * Get libelleTypeAct
     *
     * @return string
     */
    public function getLibelleTypeAct()
    {
        return $this->libelleTypeAct;
    }
}


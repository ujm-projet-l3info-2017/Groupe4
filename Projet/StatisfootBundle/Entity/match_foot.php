<?php

namespace Projet\StatisfootBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * match_foot
 *
 * @ORM\Table(name="match_foot")
 * @ORM\Entity(repositoryClass="Projet\StatisfootBundle\Repository\match_footRepository")
 */
class match_foot
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
     * @var \DateTime
     *
     * @ORM\Column(name="date_match", type="datetime")
     */
    private $dateMatch;

    /**
     * @var string
     *
     * @ORM\Column(name="lieu", type="string", length=40)
     */
    private $lieu;

    /**
    * @ORM\ManyToOne(targetEntity="Projet\StatisfootBundle\Entity\competition")
    * @ORM\JoinColumn(nullable=false)
    */

    private $competition;


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
     * Set dateMatch
     *
     * @param \DateTime $dateMatch
     *
     * @return match_foot
     */
    public function setDateMatch($dateMatch)
    {
        $this->dateMatch = $dateMatch;

        return $this;
    }

    /**
     * Get dateMatch
     *
     * @return \DateTime
     */
    public function getDateMatch()
    {
        return $this->dateMatch;
    }

    /**
     * Set lieu
     *
     * @param string $lieu
     *
     * @return match_foot
     */
    public function setLieu($lieu)
    {
        $this->lieu = $lieu;

        return $this;
    }

    /**
     * Get lieu
     *
     * @return string
     */
    public function getLieu()
    {
        return $this->lieu;
    }

    /**
     * Set competition
     *
     * @param \Projet\StatisfootBundle\Entity\competition $competition
     *
     * @return match_foot
     */
    public function setCompetition(\Projet\StatisfootBundle\Entity\competition $competition)
    {
        $this->competition = $competition;

        return $this;
    }

    /**
     * Get competition
     *
     * @return \Projet\StatisfootBundle\Entity\competition
     */
    public function getCompetition()
    {
        return $this->competition;
    }
}

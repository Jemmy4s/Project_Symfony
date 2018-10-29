<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ressource
 *
 * @ORM\Table(name="ressource")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RessourceRepository")
 */
class Ressource
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
     * @ORM\Column(name="proprietere", type="integer")
     */
    private $proprietere;

    /**
     * @var int
     *
     * @ORM\Column(name="Fer", type="integer")
     */
    private $fer;

    /**
     * @var int
     *
     * @ORM\Column(name="Argent", type="integer")
     */
    private $argent;

    /**
     * @var int
     *
     * @ORM\Column(name="Charbon", type="integer")
     */
    private $charbon;

    /**
     * @var int
     *
     * @ORM\Column(name="Energie", type="integer")
     */
    private $energie;

    /**
     * @var int
     *
     * @ORM\Column(name="Nourriture", type="integer")
     */
    private $nourriture;

    /**
     * @var int
     *
     * @ORM\Column(name="Acier", type="integer")
     */
    private $acier;

    public function __construct(){
        $this->nourriture=10;
        $this->energie=0;
        $this->charbon =0;
        $this->argent =0;
        $this->fer=0;
        $this->acier=0;
    }
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
     * Set proprietere
     *
     * @param integer $proprietere
     *
     * @return Ressource
     */
    public function setProprietere($proprietere)
    {
        $this->proprietere = $proprietere;

        return $this;
    }

    /**
     * Get proprietere
     *
     * @return int
     */
    public function getProprietere()
    {
        return $this->proprietere;
    }

    /**
     * Set fer
     *
     * @param integer $fer
     *
     * @return Ressource
     */
    public function setFer($fer)
    {
        $this->fer = $fer;

        return $this;
    }

    /**
     * Get fer
     *
     * @return int
     */
    public function getFer()
    {
        return $this->fer;
    }

    /**
     * Set argent
     *
     * @param integer $argent
     *
     * @return Ressource
     */
    public function setArgent($argent)
    {
        $this->argent = $argent;

        return $this;
    }

    /**
     * Get argent
     *
     * @return int
     */
    public function getArgent()
    {
        return $this->argent;
    }

    /**
     * Set charbon
     *
     * @param integer $charbon
     *
     * @return Ressource
     */
    public function setCharbon($charbon)
    {
        $this->charbon = $charbon;

        return $this;
    }

    /**
     * Get charbon
     *
     * @return int
     */
    public function getCharbon()
    {
        return $this->charbon;
    }

    /**
     * Set energie
     *
     * @param integer $energie
     *
     * @return Ressource
     */
    public function setEnergie($energie)
    {
        $this->energie = $energie;

        return $this;
    }

    /**
     * Get energie
     *
     * @return int
     */
    public function getEnergie()
    {
        return $this->energie;
    }

    /**
     * Set nourriture
     *
     * @param integer $nourriture
     *
     * @return Ressource
     */
    public function setNourriture($nourriture)
    {
        $this->nourriture = $nourriture;

        return $this;
    }

    /**
     * Get nourriture
     *
     * @return int
     */
    public function getNourriture()
    {
        return $this->nourriture;
    }

    /**
     * Set acier
     *
     * @param integer $acier
     *
     * @return Ressource
     */
    public function setAcier($acier)
    {
        $this->acier = $acier;

        return $this;
    }

    /**
     * Get acier
     *
     * @return int
     */
    public function getAcier()
    {
        return $this->acier;
    }
}

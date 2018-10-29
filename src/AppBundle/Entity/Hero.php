<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Hero
 *
 * @ORM\Table(name="hero")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\HeroRepository")
 */
class Hero
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
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var int
     *
     * @ORM\Column(name="niveau", type="integer")
     */
    private $niveau;

    /**
     * @var int
     *
     * @ORM\Column(name="point_action", type="integer")
     */
    private $pointAction;

    /**
     * @var array
     *
     * @ORM\Column(name="inventaire", type="array")
     */
    private $inventaire;

    /**
     * @var object
     *
     * @ORM\Column(name="proprietere", type="object", unique=false)
     */
    private $proprietere;

    /**
     * @var int
     *
     * @ORM\Column(name="propid", type="integer", unique=false)
     */
    private $propid;

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
     * Set nom
     *
     * @param string $nom
     *
     * @return Hero
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }


        /**
         * Set propid
         *
         * @param string $propid
         *
         * @return Hero
         */
        public function setPropid($propid)
        {
            $this->propid = $propid;

            return $this;
        }

        /**
         * Get nom
         *
         * @return string
         */
        public function getPropid()
        {
            return $this->propid;
        }

    /**
     * Set niveau
     *
     * @param integer $niveau
     *
     * @return Hero
     */
    public function setNiveau($niveau)
    {
        $this->niveau = $niveau;

        return $this;
    }

    /**
     * Get niveau
     *
     * @return int
     */
    public function getNiveau()
    {
        return $this->niveau;
    }

    /**
     * Set pointAction
     *
     * @param integer $pointAction
     *
     * @return Hero
     */
    public function setPointAction($pointAction)
    {
        $this->pointAction = $pointAction;

        return $this;
    }

    /**
     * Get pointAction
     *
     * @return int
     */
    public function getPointAction()
    {
        return $this->pointAction;
    }

    /**
     * Set inventaire
     *
     * @param array $inventaire
     *
     * @return Hero
     */
    public function setInventaire($inventaire)
    {
        $this->inventaire = $inventaire;

        return $this;
    }

    /**
     * Get inventaire
     *
     * @return array
     */
    public function getInventaire()
    {
        return $this->inventaire;
    }

    /**
     * Set proprietere
     *
     * @param object $proprietere
     *
     * @return Hero
     */
    public function setProprietere($proprietere)
    {
        $this->proprietere = $proprietere;

        return $this;
    }

    /**
     * Get proprietere
     *
     * @return object
     */
    public function getProprietere()
    {
        return $this->proprietere;
    }
    public function manger(){
        $this->pointAction = $this->pointAction -2;
        return $this;
    }
}

<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Message
 *
 * @ORM\Table(name="message")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MessageRepository")
 */
class Message
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
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="jour", type="date")
     */
    private $jour;

    /**
     * @var int
     *
     * @ORM\Column(name="envoyeur", type="integer")
     */
    private $envoyeur;

    /**
     * @var int
     *
     * @ORM\Column(name="receveur", type="integer")
     */
    private $receveur;

    /**
     * @var string
     *
     * @ORM\Column(name="entete", type="string", length=255)
     */
    private $entete;

    /**
     * @var string
     *
     * @ORM\Column(name="texte", type="text")
     */
    private $texte;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="heure", type="time")
     */
    private $heure;


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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Message
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set jour
     *
     * @param \DateTime $jour
     *
     * @return Message
     */
    public function setJour($jour)
    {
        $this->jour = $jour;

        return $this;
    }

    /**
     * Get jour
     *
     * @return \DateTime
     */
    public function getJour()
    {
        return $this->jour;
    }

    /**
     * Set envoyeur
     *
     * @param integer $envoyeur
     *
     * @return Message
     */
    public function setEnvoyeur($envoyeur)
    {
        $this->envoyeur = $envoyeur;

        return $this;
    }

    /**
     * Get envoyeur
     *
     * @return int
     */
    public function getEnvoyeur()
    {
        return $this->envoyeur;
    }

    /**
     * Set receveur
     *
     * @param integer $receveur
     *
     * @return Message
     */
    public function setReceveur($receveur)
    {
        $this->receveur = $receveur;

        return $this;
    }

    /**
     * Get receveur
     *
     * @return int
     */
    public function getReceveur()
    {
        return $this->receveur;
    }

    /**
     * Set entete
     *
     * @param string $entete
     *
     * @return Message
     */
    public function setEntete($entete)
    {
        $this->entete = $entete;

        return $this;
    }

    /**
     * Get entete
     *
     * @return string
     */
    public function getEntete()
    {
        return $this->entete;
    }

    /**
     * Set texte
     *
     * @param string $texte
     *
     * @return Message
     */
    public function setTexte($texte)
    {
        $this->texte = $texte;

        return $this;
    }

    /**
     * Get texte
     *
     * @return string
     */
    public function getTexte()
    {
        return $this->texte;
    }

    /**
     * Set heure
     *
     * @param \DateTime $heure
     *
     * @return Message
     */
    public function setHeure($heure)
    {
        $this->heure = $heure;

        return $this;
    }

    /**
     * Get heure
     *
     * @return \DateTime
     */
    public function getHeure()
    {
        return $this->heure;
    }
}


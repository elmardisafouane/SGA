<?php

namespace AbsenceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Classe
 *
 * @ORM\Table(name="classe")
 * @ORM\Entity(repositoryClass="AbsenceBundle\Repository\ClasseRepository")
 */
class Classe
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
     * @ORM\OneToMany(targetEntity="AbsenceBundle\Entity\Etudiant", mappedBy="classe")
     * * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private $etudiants;

    /**
     * @ORM\OneToMany(targetEntity="AbsenceBundle\Entity\Absence", mappedBy="classe")
     * * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private $absences;




    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;


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
     * @return Classe
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
     * Constructor
     */
    public function __construct()
    {
        $this->etudiants = new \Doctrine\Common\Collections\ArrayCollection();
        $this->absences = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add etudiant
     *
     * @param \AbsenceBundle\Entity\Etudiant $etudiant
     *
     * @return Classe
     */
    public function addEtudiant(\AbsenceBundle\Entity\Etudiant $etudiant)
    {
        $this->etudiants[] = $etudiant;

        return $this;
    }

    /**
     * Remove etudiant
     *
     * @param \AbsenceBundle\Entity\Etudiant $etudiant
     */
    public function removeEtudiant(\AbsenceBundle\Entity\Etudiant $etudiant)
    {
        $this->etudiants->removeElement($etudiant);
    }

    /**
     * Get etudiants
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEtudiants()
    {
        return $this->etudiants;
    }

    /**
     * Add absence
     *
     * @param \AbsenceBundle\Entity\Absence $absence
     *
     * @return Classe
     */
    public function addAbsence(\AbsenceBundle\Entity\Absence $absence)
    {
        $this->absences[] = $absence;

        return $this;
    }

    /**
     * Remove absence
     *
     * @param \AbsenceBundle\Entity\Absence $absence
     */
    public function removeAbsence(\AbsenceBundle\Entity\Absence $absence)
    {
        $this->absences->removeElement($absence);
    }

    /**
     * Get absences
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAbsences()
    {
        return $this->absences;
    }
}

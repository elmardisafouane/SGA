<?php

namespace AbsenceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Etudiant
 *
 * @ORM\Table(name="etudiant")
 * @ORM\Entity(repositoryClass="AbsenceBundle\Repository\EtudiantRepository")
 */
class Etudiant
{
    /**
     * @ORM\ManyToOne( targetEntity="AbsenceBundle\Entity\Classe", inversedBy="etudiants")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private $classe;

    /**
     * @ORM\OneToMany(targetEntity="AbsenceBundle\Entity\Absence", mappedBy="etudiant")
     * * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private $absences;

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
     * @return Etudiant
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
     * Set classe
     *
     * @param \AbsenceBundle\Entity\Classe $classe
     *
     * @return Etudiant
     */
    public function setClasse(\AbsenceBundle\Entity\Classe $classe)
    {
        $this->classe = $classe;

        return $this;
    }

    /**
     * Get classe
     *
     * @return \AbsenceBundle\Entity\Classe
     */
    public function getClasse()
    {
        return $this->classe;
    }


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->absences = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add absence
     *
     * @param \AbsenceBundle\Entity\Absence $absence
     *
     * @return Etudiant
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

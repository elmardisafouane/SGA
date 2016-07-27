<?php

namespace AbsenceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Absence
 *
 * @ORM\Table(name="absence")
 * @ORM\Entity(repositoryClass="AbsenceBundle\Repository\AbsenceRepository")
 */
class Absence
{
    /**
     * @ORM\ManyToOne( targetEntity="AbsenceBundle\Entity\Etudiant", inversedBy="absences")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private $etudiant;

    

    /**
     * @ORM\ManyToOne( targetEntity="AbsenceBundle\Entity\Classe", inversedBy="absences")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private $classe;



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
     * @var int
     *
     * @ORM\Column(name="nb_vacation", type="integer")
     */
    private $nbVacation;


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
     * @return Absence
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
     * Set nbVacation
     *
     * @param integer $nbVacation
     *
     * @return Absence
     */
    public function setNbVacation($nbVacation)
    {
        $this->nbVacation = $nbVacation;

        return $this;
    }

    /**
     * Get nbVacation
     *
     * @return int
     */
    public function getNbVacation()
    {
        return $this->nbVacation;
    }

    /**
     * Set etudiant
     *
     * @param \AbsenceBundle\Entity\Etudiant $etudiant
     *
     * @return Absence
     */
    public function setEtudiant(\AbsenceBundle\Entity\Etudiant $etudiant)
    {
        $this->etudiant = $etudiant;

        return $this;
    }

    /**
     * Get etudiant
     *
     * @return \AbsenceBundle\Entity\Etudiant
     */
    public function getEtudiant()
    {
        return $this->etudiant;
    }

    /**
     * Set classe
     *
     * @param \AbsenceBundle\Entity\Classe $classe
     *
     * @return Absence
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
}

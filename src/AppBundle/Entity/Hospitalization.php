<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Hospitalization
 *
 * @ORM\Table(name="hospitalization", indexes={@ORM\Index(name="fk_doctor_hospitalization", columns={"doctor_id"}),
 *     @ORM\Index(name="fk_department_hospitalization", columns={"department_id"}),
 *     @ORM\Index(name="fk_patient_hospitalization", columns={"patient_id"})})
 * @ORM\Entity
 */
class Hospitalization
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_from", type="datetime", nullable=false)
     */
    private $dateFrom = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_to", type="datetime", nullable=true)
     */
    private $dateTo;

    /**
     * @var Doctor
     *
     * @ORM\ManyToOne(targetEntity="Doctor", inversedBy="hospitalizations")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="doctor_id", referencedColumnName="id")
     * })
     */
    private $doctor;

    /**
     * @var Department
     *
     * @ORM\ManyToOne(targetEntity="Department", inversedBy="hospitalizations")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="department_id", referencedColumnName="id")
     * })
     */
    private $department;

    /**
     * @var Patient
     *
     * @ORM\ManyToOne(targetEntity="Patient", inversedBy="hospitalizations")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="patient_id", referencedColumnName="id")
     * })
     */
    private $patient;

    /**
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Examination", mappedBy="hospitalization")
     */
    private $examinations;

    /**
     * Hospitalization constructor.
     */
    public function __construct()
    {
        $this->examinations = new ArrayCollection();
    }


    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Hospitalization
     */
    public function setId(int $id): Hospitalization
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getDateFrom(): ?\DateTime
    {
        return $this->dateFrom;
    }

    /**
     * @param \DateTime $dateFrom
     * @return Hospitalization
     */
    public function setDateFrom(\DateTime $dateFrom): Hospitalization
    {
        $this->dateFrom = $dateFrom;

        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getDateTo(): ?\DateTime
    {
        return $this->dateTo;
    }

    /**
     * @param \DateTime $dateTo
     * @return Hospitalization
     */
    public function setDateTo(\DateTime $dateTo): Hospitalization
    {
        $this->dateTo = $dateTo;

        return $this;
    }

    /**
     * @return Doctor|null
     */
    public function getDoctor(): ?Doctor
    {
        return $this->doctor;
    }

    /**
     * @param Doctor $doctor
     * @return Hospitalization
     */
    public function setDoctor(Doctor $doctor): Hospitalization
    {
        $this->doctor = $doctor;

        return $this;
    }

    /**
     * @return Department|null
     */
    public function getDepartment(): ?Department
    {
        return $this->department;
    }

    /**
     * @param Department $department
     * @return Hospitalization
     */
    public function setDepartment(Department $department): Hospitalization
    {
        $this->department = $department;

        return $this;
    }

    /**
     * @return Patient|null
     */
    public function getPatient(): ?Patient
    {
        return $this->patient;
    }

    /**
     * @param Patient $patient
     * @return Hospitalization
     */
    public function setPatient(Patient $patient): Hospitalization
    {
        $this->patient = $patient;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getExaminations(): Collection
    {
        return $this->examinations;
    }

    /**
     * @param Collection $examinations
     * @return Hospitalization
     */
    public function setExaminations(Collection $examinations): Hospitalization
    {
        $this->examinations = $examinations;

        return $this;
    }
}


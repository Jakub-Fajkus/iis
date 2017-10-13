<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Examination
 *
 * @ORM\Table(name="examination", indexes={@ORM\Index(name="fk_doctor_examination", columns={"doctor_id"}),
 *     @ORM\Index(name="fk_hospitalization_examination", columns={"id_hospitalization"})})
 * @ORM\Entity
 */
class Examination
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
     * @ORM\Column(name="date", type="datetime", nullable=false)
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="report", type="string", length=4000, nullable=true)
     */
    private $report;

    /**
     * @var Hospitalization
     *
     * @ORM\ManyToOne(targetEntity="Hospitalization", inversedBy="examinations")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_hospitalization", referencedColumnName="id")
     * })
     */
    private $hospitalization;

    /**
     * @var Doctor
     *
     * @ORM\ManyToOne(targetEntity="Doctor", inversedBy="examinations")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="doctor_id", referencedColumnName="id")
     * })
     */
    private $doctor;

    /**
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Prescription", mappedBy="examination")
     */
    private $prescriptions;

    /**
     * Examination constructor.
     */
    public function __construct()
    {
        $this->prescriptions = new ArrayCollection();
        $this->date = new \DateTime();
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
     * @return Examination
     */
    public function setId(int $id): Examination
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getDate(): ?\DateTime
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     * @return Examination
     */
    public function setDate(\DateTime $date): Examination
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getReport(): ?string
    {
        return $this->report;
    }

    /**
     * @param string $report
     * @return Examination
     */
    public function setReport(string $report): Examination
    {
        $this->report = $report;

        return $this;
    }

    /**
     * @return Hospitalization|null
     */
    public function getHospitalization(): ?Hospitalization
    {
        return $this->hospitalization;
    }

    /**
     * @param Hospitalization $hospitalization
     * @return Examination
     */
    public function setHospitalization(Hospitalization $hospitalization): Examination
    {
        $this->hospitalization = $hospitalization;

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
     * @return Examination
     */
    public function setDoctor(Doctor $doctor): Examination
    {
        $this->doctor = $doctor;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getPrescriptions(): Collection
    {
        return $this->prescriptions;
    }

    /**
     * @param Collection $prescriptions
     * @return Examination
     */
    public function setPrescriptions(Collection $prescriptions): Examination
    {
        $this->prescriptions = $prescriptions;

        return $this;
    }


    /**
     * @param Prescription $prescription
     * @return $this
     */
    public function addPrescription(Prescription $prescription): Examination
    {
        if (!$this->prescriptions->contains($prescription)) {
            $this->prescriptions->add($prescription);
        }

        return $this;
    }


    /**
     * @param Prescription $prescription
     * @return $this
     */
    public function removePrescription(Prescription $prescription): Examination
    {
        $this->prescriptions->remove($prescription);

        return $this;
    }

}


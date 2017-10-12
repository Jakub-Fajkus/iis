<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Employment
 *
 * @ORM\Table(name="employment", indexes={@ORM\Index(name="fk_doctor_employment", columns={"doctor_id"}),
 *     @ORM\Index(name="fk_department_employment", columns={"department_id"})})
 * @ORM\Entity
 */
class Employment
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
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=30, nullable=false)
     */
    private $type;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_from", type="datetime", nullable=false)
     */
    private $dateFrom;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_to", type="datetime", nullable=true)
     */
    private $dateTo;

    /**
     * @var Doctor
     *
     * @ORM\ManyToOne(targetEntity="Doctor", inversedBy="employments")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="doctor_id", referencedColumnName="id")
     * })
     */
    private $doctor;

    /**
     * @var Department
     *
     * @ORM\ManyToOne(targetEntity="Department", inversedBy="employments")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="department_id", referencedColumnName="id")
     * })
     */
    private $department;

    /**
     * Employment constructor.
     */
    public function __construct()
    {
        $this->dateFrom = new \DateTime();
    }


    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Employment
     */
    public function setId(int $id): Employment
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return Employment
     */
    public function setType(string $type): Employment
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDateFrom(): ?\DateTime
    {
        return $this->dateFrom;
    }

    /**
     * @param \DateTime $dateFrom
     * @return Employment
     */
    public function setDateFrom(\DateTime $dateFrom): Employment
    {
        $this->dateFrom = $dateFrom;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDateTo(): ?\DateTime
    {
        return $this->dateTo;
    }

    /**
     * @param \DateTime $dateTo
     * @return Employment
     */
    public function setDateTo(\DateTime $dateTo = null): Employment
    {
        $this->dateTo = $dateTo;
        return $this;
    }

    /**
     * @return Doctor
     */
    public function getDoctor(): ?Doctor
    {
        return $this->doctor;
    }

    /**
     * @param Doctor $doctor
     * @return Employment
     */
    public function setDoctor(Doctor $doctor): Employment
    {
        $this->doctor = $doctor;
        return $this;
    }

    /**
     * @return Department
     */
    public function getDepartment(): ?Department
    {
        return $this->department;
    }

    /**
     * @param Department $department
     * @return Employment
     */
    public function setDepartment(Department $department): Employment
    {
        $this->department = $department;
        return $this;
    }


}


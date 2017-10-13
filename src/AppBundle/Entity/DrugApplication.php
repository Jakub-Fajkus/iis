<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DrugApplication
 *
 * @ORM\Table(name="drug_application", indexes={@ORM\Index(name="fk_prescription_application", columns={"id_prescription"})})
 * @ORM\Entity
 */
class DrugApplication
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
     * @ORM\Column(name="time", type="datetime", nullable=false)
     */
    private $time;

    /**
     * @var string Username of the person that applied the drug
     *
     * @ORM\Column(name="appliedBy", type="string", length=30, nullable=true)
     */
    private $appliedBy;

    /**
     * @var Prescription
     *
     * @ORM\ManyToOne(targetEntity="Prescription", inversedBy="applications")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_prescription", referencedColumnName="id")
     * })
     */
    private $prescription;


    /**
     * DrugApplication constructor.
     */
    public function __construct()
    {
        $this->time = new \DateTime();
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
     * @return DrugApplication
     */
    public function setId(int $id): DrugApplication
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getTime(): ?\DateTime
    {
        return $this->time;
    }

    /**
     * @param \DateTime $time
     * @return DrugApplication
     */
    public function setTime(\DateTime $time): DrugApplication
    {
        $this->time = $time;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getAppliedBy(): ?string
    {
        return $this->appliedBy;
    }

    /**
     * @param string $appliedBy
     * @return DrugApplication
     */
    public function setAppliedBy(string $appliedBy): DrugApplication
    {
        $this->appliedBy = $appliedBy;

        return $this;
    }

    /**
     * @return Prescription|null
     */
    public function getPrescription(): ?Prescription
    {
        return $this->prescription;
    }

    /**
     * @param Prescription $prescription
     * @return DrugApplication
     */
    public function setPrescription(Prescription $prescription): DrugApplication
    {
        $this->prescription = $prescription;

        return $this;
    }

}


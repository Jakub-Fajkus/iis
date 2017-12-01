<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Prescription
 *
 * @ORM\Table(name="prescritpion", indexes={@ORM\Index(name="fk_examination_prescription", columns={"examination_id"}),
 *     @ORM\Index(name="fk_drug_prescription", columns={"drug_id"})})
 * @ORM\Entity
 */
class Prescription
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
     * @var integer
     *
     * @ORM\Column(name="period_of_application", type="integer", nullable=false)
     */
    private $periodOfApplication;

    /**
     * @var string Injection,Oral,...
     *
     * @ORM\Column(name="delivery", type="string", length=30, nullable=false)
     */
    private $delivery;

    /**
     * @var string 1 tablet, 10ml
     *
     * @Assert\NotBlank()
     * @Assert\Length(min=1, max=30)
     *
     * @ORM\Column(name="amount", type="string", length=30, nullable=false)
     */
    private $amount;

    /**
     * @var Drug
     *
     * @ORM\ManyToOne(targetEntity="Drug", inversedBy="prescriptions")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="drug_id", referencedColumnName="id")
     * })
     */
    private $drug;

    /**
     * @var Examination
     *
     * @ORM\ManyToOne(targetEntity="Examination", inversedBy="prescriptions")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="examination_id", referencedColumnName="id")
     * })
     */
    private $examination;

    /**
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\DrugApplication", mappedBy="prescription")
     */
    private $applications;

    /**
     * Prescription constructor.
     */
    public function __construct()
    {
        $this->applications = new ArrayCollection();
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
     * @return Prescription
     */
    public function setId(int $id): Prescription
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getPeriodOfApplication(): ?int
    {
        return $this->periodOfApplication;
    }

    /**
     * @param int $periodOfApplication
     * @return Prescription
     */
    public function setPeriodOfApplication(int $periodOfApplication): Prescription
    {
        $this->periodOfApplication = $periodOfApplication;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDelivery(): ?string
    {
        return $this->delivery;
    }

    /**
     * @param string $delivery
     * @return Prescription
     */
    public function setDelivery(string $delivery): Prescription
    {
        $this->delivery = $delivery;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getAmount(): ?string
    {
        return $this->amount;
    }

    /**
     * @param string $amount
     * @return Prescription
     */
    public function setAmount(string $amount): Prescription
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * @return Drug|null
     */
    public function getDrug(): ?Drug
    {
        return $this->drug;
    }

    /**
     * @param Drug $drug
     * @return Prescription
     */
    public function setDrug(Drug $drug): Prescription
    {
        $this->drug = $drug;

        return $this;
    }

    /**
     * @return Examination|null
     */
    public function getExamination(): ?Examination
    {
        return $this->examination;
    }

    /**
     * @param Examination $examination
     * @return Prescription
     */
    public function setExamination(Examination $examination): Prescription
    {
        $this->examination = $examination;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getApplications(): Collection
    {
        return $this->applications;
    }

    /**
     * @param Collection $applications
     * @return Prescription
     */
    public function setApplications(Collection $applications): Prescription
    {
        $this->applications = $applications;

        return $this;
    }


    /**
     * @param DrugApplication $application
     * @return $this
     */
    public function addApplication(DrugApplication $application)
    {
        if (!$this->applications->contains($application)) {
            $this->applications->add($application);
        }

        return $this;
    }


    /**
     * @param DrugApplication $application
     * @return $this
     */
    public function removeApplication(DrugApplication $application)
    {
        $this->applications->remove($application);

        return $this;
    }
}

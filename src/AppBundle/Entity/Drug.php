<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Drug
 *
 * @ORM\Table(name="drug")
 * @ORM\Entity
 */
class Drug
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
     * @ORM\Column(name="name", type="string", length=70, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="main_substance", type="string", length=100, nullable=false)
     */
    private $mainSubstance;

    /**
     * @var string Reasons to not to give the drug
     *
     * @ORM\Column(name="contraindication", type="string", length=3000, nullable=true)
     */
    private $contraindication;

    /**
     * @var string Amount of the main substance
     *
     * @ORM\Column(name="substance_amount", type="string", length=20, nullable=false)
     */
    private $substanceAmount;

    /**
     * @var string
     *
     * @ORM\Column(name="recommended_dosage", type="string", length=30, nullable=false)
     */
    private $recommendedDosage;

    /**
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Prescription", mappedBy="drug")
     */
    private $prescriptions;

    /**
     * Drug constructor.
     */
    public function __construct()
    {
        $this->prescriptions = new ArrayCollection();
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
     * @return Drug
     */
    public function setId(int $id): Drug
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Drug
     */
    public function setName(string $name): Drug
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getMainSubstance(): ?string
    {
        return $this->mainSubstance;
    }

    /**
     * @param string $mainSubstance
     * @return Drug
     */
    public function setMainSubstance(string $mainSubstance): Drug
    {
        $this->mainSubstance = $mainSubstance;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getContraindication(): ?string
    {
        return $this->contraindication;
    }

    /**
     * @param string|null $contraindication
     * @return Drug
     */
    public function setContraindication(string $contraindication): Drug
    {
        $this->contraindication = $contraindication;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSubstanceAmount(): ?string
    {
        return $this->substanceAmount;
    }

    /**
     * @param string $substanceAmount
     * @return Drug
     */
    public function setSubstanceAmount(string $substanceAmount): Drug
    {
        $this->substanceAmount = $substanceAmount;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getRecommendedDosage(): ?string
    {
        return $this->recommendedDosage;
    }

    /**
     * @param string $recommendedDosage
     * @return Drug
     */
    public function setRecommendedDosage(string $recommendedDosage): Drug
    {
        $this->recommendedDosage = $recommendedDosage;

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
     * @return Drug
     */
    public function setPrescriptions(Collection $prescriptions): Drug
    {
        $this->prescriptions = $prescriptions;

        return $this;
    }
}


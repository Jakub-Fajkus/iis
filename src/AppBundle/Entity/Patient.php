<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Pacient
 *
 * @ORM\Table(name="patient")
 * @ORM\Entity(repositoryClass="PatientRepository")
 */
class Patient
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
     * @Assert\NotBlank()
     * @Assert\Length(min = 1, max = 40)
     *
     * @ORM\Column(name="name", type="string", length=40, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Length(min = 1, max = 40)
     *
     * @ORM\Column(name="surname", type="string", length=40, nullable=false)
     */
    private $surname;

    /**
     * @var string "Rodne cislo" or "Social Security number"
     *
     * @Assert\NotBlank()
     * @Assert\Length(min=10, max=11)
     * @Assert\Regex("/^[0-9]{6}\/[0-9]{3,4}$/", message="Zadejte ve tvaru 901028/5341", htmlPattern="")
     *
     * @ORM\Column(name="personal_identification_number", type="string", length=30,  nullable=false)
     */
    private $personalIdentificationNumber;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Length(min=1, max=50)
     *
     * @ORM\Column(name="street", type="string", length=50, nullable=false)
     */
    private $street;

    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Length(min=1, max=20)
     *
     * @ORM\Column(name="house_number", type="string", length=20, nullable=false)
     */
    private $houseNumber;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Length(min=1, max=50)
     *
     * @ORM\Column(name="city", type="string", length=50, nullable=false)
     */
    private $city;

    /**
     * @var integer
     *
     * @Assert\NotBlank()
     * @Assert\Length(min=5, max=20)
     *
     * @ORM\Column(name="zip", type="string", length=20, nullable=false)
     */
    private $zip;

    /**
     * @var string "Cislo pojistence"
     *
     * @Assert\NotBlank()
     * @Assert\Length(min=10, max=30)
     * @Assert\Regex("/^[0-9]{6}\/[0-9]{3,4}$/", message="Zadejte ve tvaru 901028/5341", htmlPattern="")
     *
     * @ORM\Column(name="medical_identification_number", type="string", length=30, nullable=false)
     */
    private $medicalIdentificationNumber;

    /**
     * @var integer
     *
     * @ORM\Column(name="insurance_company_id", type="integer", nullable=false)
     * @Assert\NotBlank()
     * @Assert\Length(min=3, max=3)
     */
    private $insuranceCompanyId;

    /**
     * @var string
     *
     * @ORM\Column(name="isWoman", type="boolean", nullable=false)
     */
    private $isWoman;

    /**
     * @var Collection
     *
     * @ORM\OrderBy(value={"dateFrom": "DESC"})
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Hospitalization", mappedBy="patient", cascade={"PERSIST"})
     */
    private $hospitalizations;

    /**
     * Patient constructor.
     */
    public function __construct()
    {
        $this->hospitalizations = new ArrayCollection();
        $this->isWoman = false;
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
     * @return Patient
     */
    public function setId(int $id): Patient
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
     * @return Patient
     */
    public function setName(string $name): Patient
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSurname(): ?string
    {
        return $this->surname;
    }

    /**
     * @param string $surname
     * @return Patient
     */
    public function setSurname(string $surname): Patient
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPersonalIdentificationNumber(): ?string
    {
        return $this->personalIdentificationNumber;
    }

    /**
     * @param string $personalIdentificationNumber
     * @return Patient
     */
    public function setPersonalIdentificationNumber(string $personalIdentificationNumber): Patient
    {
        $this->personalIdentificationNumber = $personalIdentificationNumber;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getStreet(): ?string
    {
        return $this->street;
    }

    /**
     * @param string $street
     * @return Patient
     */
    public function setStreet(string $street): Patient
    {
        $this->street = $street;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getHouseNumber(): ?string
    {
        return $this->houseNumber;
    }

    /**
     * @param string $houseNumber
     * @return Patient
     */
    public function setHouseNumber(string $houseNumber): Patient
    {
        $this->houseNumber = $houseNumber;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * @param string $city
     * @return Patient
     */
    public function setCity(string $city): Patient
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getZip(): ?string
    {
        return $this->zip;
    }

    /**
     * @param string $zip
     * @return Patient
     */
    public function setZip(string $zip): Patient
    {
        $this->zip = $zip;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getMedicalIdentificationNumber(): ?string
    {
        return $this->medicalIdentificationNumber;
    }

    /**
     * @param string $medicalIdentificationNumber
     * @return Patient
     */
    public function setMedicalIdentificationNumber(string $medicalIdentificationNumber): Patient
    {
        $this->medicalIdentificationNumber = $medicalIdentificationNumber;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getInsuranceCompanyId(): ?int
    {
        return $this->insuranceCompanyId;
    }

    /**
     * @param int $insuranceCompanyId
     * @return Patient
     */
    public function setInsuranceCompanyId(int $insuranceCompanyId): Patient
    {
        $this->insuranceCompanyId = $insuranceCompanyId;

        return $this;
    }

    /**
     * @return bool
     */
    public function isWoman(): bool
    {
        return $this->isWoman;
    }

    /**
     * @param bool $isWoman
     */
    public function setIsWoman(bool $isWoman)
    {
        $this->isWoman = $isWoman;
    }

    /**
     * @return Collection
     */
    public function getHospitalizations(): Collection
    {
        return $this->hospitalizations;
    }

    /**
     * @param Collection $hospitalizations
     *
     * @return Patient
     */
    public function setHospitalizations(Collection $hospitalizations): Patient
    {
        $this->hospitalizations = $hospitalizations;

        return $this;
    }


    /**
     * Is there a current hospitalization
     *
     * @return bool
     */
    public function isHospitalized(): bool
    {
        return $this->getCurrentHospitalization() !== null;
    }

    /**
     * Get the current hospitalization or null
     *
     * @return Hospitalization|null
     */
    public function getCurrentHospitalization(): ?Hospitalization
    {
        /** @var Hospitalization $hospitalization */
        foreach ($this->hospitalizations as $hospitalization) {
            if ($hospitalization->getDateTo() === null) {
                return $hospitalization;
            }
        }

        return null;
    }

    /**
     * @return string
     */
    public function getFullName(): string
    {
        return $this->name . ' ' . $this->surname;
    }

}


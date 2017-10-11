<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Pacient
 *
 * @ORM\Table(name="patient")
 * @ORM\Entity
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
     * @ORM\Column(name="name", type="string", length=40, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="surname", type="string", length=40, nullable=false)
     */
    private $surname;

    /**
     * @var string "Rodne cislo" or "Social Security number"
     *
     * @ORM\Column(name="personal_identification_number", type="string", length=30,  nullable=false)
     */
    private $personalIdentificationNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="street", type="string", length=50, nullable=false)
     */
    private $street;

    /**
     * @var string
     *
     * @ORM\Column(name="house_number", type="string", length=20, nullable=false)
     */
    private $houseNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=50, nullable=false)
     */
    private $city;

    /**
     * @var integer
     *
     * @ORM\Column(name="zip", type="string", length=20, nullable=false)
     */
    private $zip;

    /**
     * @var string "Cislo pojistence"
     *
     * @ORM\Column(name="medical_identification_number", type="string", length=30, nullable=false)
     */
    private $medicalIdentificationNumber;

    /**
     * @var integer
     *
     * @ORM\Column(name="insurance_company_id", type="integer", nullable=false)
     */
    private $insuranceCompanyId;

    /**
     * @var string
     *
     * @ORM\Column(name="gender", type="string", length=2, nullable=false)
     */
    private $gender; //todo: select WO,MA,OT,...

    /**
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Hospitalization", mappedBy="patient")
     */
    private $hospitalizations;

    /**
     * Patient constructor.
     */
    public function __construct()
    {
        $this->hospitalizations = new ArrayCollection();
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
     * @return string|null
     */
    public function getGender(): ?string
    {
        return $this->gender;
    }

    /**
     * @param string $gender
     * @return Patient
     */
    public function setGender(string $gender): Patient
    {
        $this->gender = $gender;

        return $this;
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


}


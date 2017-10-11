<?php

namespace AppBundle\Entity;

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

}


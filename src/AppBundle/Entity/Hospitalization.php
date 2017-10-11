<?php

namespace AppBundle\Entity;

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
}


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


}


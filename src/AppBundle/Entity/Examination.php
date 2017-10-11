<?php

namespace AppBundle\Entity;

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
    private $date = 'CURRENT_TIMESTAMP';

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


}


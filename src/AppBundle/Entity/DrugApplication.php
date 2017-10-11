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
    private $time = 'CURRENT_TIMESTAMP';

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


}


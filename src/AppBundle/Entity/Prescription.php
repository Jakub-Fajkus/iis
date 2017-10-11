<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

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


}


<?php

namespace AppBundle\Entity;

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

}


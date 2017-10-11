<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Department
 *
 * @ORM\Table(name="department")
 * @ORM\Entity
 */
class Department
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
     * @ORM\Column(name="shortcut", type="string", length=8, nullable=false)
     */
    private $shortcut;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=70, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="telephone", type="string", length=20, nullable=false)
     */
    private $telephone;


    /**
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Employment", mappedBy="department")
     */
    private $emoloyments;

    /**
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Hospitalization", mappedBy="department")
     */
    private $hospitalizations;

    /**
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Nurse", mappedBy="department")
     */
    private $nurses;
}


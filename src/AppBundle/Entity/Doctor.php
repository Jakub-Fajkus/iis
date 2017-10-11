<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;

/** //todo: inherit the fos user
 * Doctor
 *
 * @ORM\Table(name="doctor")
 * @ORM\Entity
 */
class Doctor
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
     * @ORM\Column(name="username", type="string", length=30, nullable=false, unique=true)
     */
    private $username;

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
     * @var string
     *
     * @ORM\Column(name="telephone", type="string", length=20, nullable=false)
     */
    private $telephone;

    /**
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Employment", mappedBy="doctor")
     */
    private $employments;

    /**
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Examination", mappedBy="doctor")
     */
    private $examinations;

    /**
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Hospitalization", mappedBy="doctor")
     */
    private $hospitalizations;
}


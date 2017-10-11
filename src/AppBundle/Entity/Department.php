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

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Department
     */
    public function setId(int $id): Department
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getShortcut(): string
    {
        return $this->shortcut;
    }

    /**
     * @param string $shortcut
     * @return Department
     */
    public function setShortcut(string $shortcut): Department
    {
        $this->shortcut = $shortcut;

        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Department
     */
    public function setName(string $name): Department
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getTelephone(): string
    {
        return $this->telephone;
    }

    /**
     * @param string $telephone
     * @return Department
     */
    public function setTelephone(string $telephone): Department
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getEmoloyments(): Collection
    {
        return $this->emoloyments;
    }

    /**
     * @param Collection $emoloyments
     * @return Department
     */
    public function setEmoloyments(Collection $emoloyments): Department
    {
        $this->emoloyments = $emoloyments;

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
     * @return Department
     */
    public function setHospitalizations(Collection $hospitalizations): Department
    {
        $this->hospitalizations = $hospitalizations;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getNurses(): Collection
    {
        return $this->nurses;
    }

    /**
     * @param Collection $nurses
     * @return Department
     */
    public function setNurses(Collection $nurses): Department
    {
        $this->nurses = $nurses;

        return $this;
    }
}

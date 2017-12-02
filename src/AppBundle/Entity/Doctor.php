<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;

/**
 * Doctor
 *
 * @ORM\Table(name="doctor")
 * @ORM\Entity
 */
class Doctor extends Employee
{
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

    /**
     * @return array
     */
    public function getDepartments(): array
    {
        $departments = [];

        /** @var Employment $employment */
        foreach ($this->employments as $employment) {
            $departments[] = $employment->getDepartment();
        }

        return $departments;
    }


    /**
     * @return Collection
     */
    public function getEmployments(): ?Collection
    {
        return $this->employments;
    }

    /**
     * @param Collection $employments
     * @return Doctor
     */
    public function setEmployments(Collection $employments): Doctor
    {
        $this->employments = $employments;
        return $this;
    }

    /**
     * @return Collection
     */
    public function getExaminations(): ?Collection
    {
        return $this->examinations;
    }

    /**
     * @param Collection $examinations
     * @return Doctor
     */
    public function setExaminations(Collection $examinations): Doctor
    {
        $this->examinations = $examinations;
        return $this;
    }

    /**
     * @return Collection
     */
    public function getHospitalizations(): ?Collection
    {
        return $this->hospitalizations;
    }

    /**
     * @param Collection $hospitalizations
     * @return Doctor
     */
    public function setHospitalizations(Collection $hospitalizations): Doctor
    {
        $this->hospitalizations = $hospitalizations;
        return $this;
    }
}


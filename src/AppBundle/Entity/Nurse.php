<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 *
 * Nurse
 *
 * @ORM\Table(name="nurse", indexes={@ORM\Index(name="fk_department_nurse", columns={"department_id"})})
 * @ORM\Entity
 */
class Nurse extends Employee
{
    /**
     * @var Department
     *
     * @ORM\ManyToOne(targetEntity="Department", inversedBy="nurses")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="department_id", referencedColumnName="id")
     * })
     */
    private $department;

    /**
     * @return Department
     */
    public function getDepartment(): ?Department
    {
        return $this->department;
    }

    /**
     * @return array
     */
    public function getDepartments(): array
    {
        return [$this->department];
    }

    /**
     * @param Department $department
     * @return Nurse
     */
    public function setDepartment(Department $department): Nurse
    {
        $this->department = $department;
        return $this;
    }


}


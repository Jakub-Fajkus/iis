<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Employee
 *
 * @ORM\Table(name="employee")
 * @ORM\Entity
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"employee" = "Employee", "nurse" = "Nurse", "doctor" = "Doctor"})
 */
class Employee extends User
{
    const ROLE_ADMIN = 'ROLE_ADMIN';
    const ROLE_SUPER_ADMIN = 'ROLE_SUPER_ADMIN';
    const ROLE_NURSE = 'ROLE_NURSE';
    const ROLE_DOCTOR = 'ROLE_DOCTOR';

    const NURSE_HANDLE = 'nurse';
    const DOCTOR_HANDLE = 'doctor';
    const ADMIN_HANDLE = 'admin';

    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Length(min=1, max=40)
     *
     * @ORM\Column(name="name", type="string", length=40, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Length(min=1, max=40)
     *
     * @ORM\Column(name="surname", type="string", length=40, nullable=false)
     */
    private $surname;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Length(min=1, max=20)
     *
     * @ORM\Column(name="telephone", type="string", length=20, nullable=false)
     */
    private $telephone;

    /**
     * Employee constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->enabled = true;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Employee
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }


    /**
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Employee
     */
    public function setName(string $name): Employee
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getSurname(): ?string
    {
        return $this->surname;
    }

    /**
     * @param string $surname
     * @return Employee
     */
    public function setSurname(string $surname): Employee
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * @return string
     */
    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    /**
     * @param string $telephone
     * @return Employee
     */
    public function setTelephone(string $telephone): Employee
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * @return string
     */
    public function getFullName(): string
    {
        return $this->name . ' ' . $this->surname;
    }

    /**
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->hasRole(static::ROLE_ADMIN);
    }

    /**
     * @return bool
     */
    public function isSuperAdmin(): bool
    {
        return $this->hasRole(static::ROLE_SUPER_ADMIN);
    }

    /**
     * @return bool
     */
    public function isNurse(): bool
    {
        return $this->hasRole(static::ROLE_NURSE);
    }

    /**
     * @return bool
     */
    public function isDoctor(): bool
    {
        return $this->hasRole(static::ROLE_DOCTOR);
    }
}

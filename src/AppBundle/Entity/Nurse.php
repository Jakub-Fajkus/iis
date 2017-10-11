<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/** //todo: inherit the fos user
 * Nurse
 *
 * @ORM\Table(name="nurse", indexes={@ORM\Index(name="fk_department_nurse", columns={"department_id"})})
 * @ORM\Entity
 */
class Nurse
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
     * @ORM\Column(name="name", type="string", length=30, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="surname", type="string", length=30, nullable=false)
     */
    private $surname;

    /**
    * @var string
    *
    * @ORM\Column(name="telephone", type="string", length=20, nullable=false)
    */
    private $telephone;

    /**
     * @var Department
     *
     * @ORM\ManyToOne(targetEntity="Department", inversedBy="nurses")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="department_id", referencedColumnName="id")
     * })
     */
    private $department;


}


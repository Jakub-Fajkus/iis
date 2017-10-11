<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User;


/**
 * Employee
 *
 * @ORM\Table(name="employee")
 * @ORM\Entity
 * @ORM\MappedSuperclass()
*/
class Employee extends User
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
}

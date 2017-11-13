<?php

namespace AppBundle\Menu;

use AppBundle\Entity\Employee;
use Knp\Menu\FactoryInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * Class AppMenuBuilder
 *
 * @package AppBundle\Menu
 */
class AppMenuBuilder
{
    /**
     * @var FactoryInterface
     */
    private $factory;

    /**
     * @var Employee
     */
    private $user;

    /**
     * @param FactoryInterface      $factory
     * @param TokenStorageInterface $tokenStorage
     */
    public function __construct(FactoryInterface $factory, TokenStorageInterface $tokenStorage)
    {
        $this->factory = $factory;
        $this->user = $tokenStorage->getToken()->getUser();
    }

    public function createAdminMenu(array $options)
    {
        $menu = $this->factory->createItem('root');

        if ($this->user->isNurse() || $this->user->isDoctor()) {
            $menu->addChild('Front', ['route' => 'app_patient_index']);
        }

        if ($this->user->isAdmin()) {
            $menu->addChild('Departments', ['route' => 'admin_department_index',]);
            $menu->addChild('Drugs', ['route' => 'admin_drug_index']);
            $menu->addChild('Employees', ['route' => 'admin_employee_index']);
        }

        return $menu;
    }

    public function createAppMenu(array $options)
    {
        $menu = $this->factory->createItem('root');

        if ($this->user->isAdmin()) {
            $menu->addChild('Admin', ['route' => 'admin_department_index']);
        }

        if ($this->user->isDoctor() || $this->user->isNurse()) {
            $menu->addChild('Patients', ['route' => 'app_patient_index']);
            $menu->addChild('Drugs', ['route' => 'app_drug_index']);
            $menu->addChild('Drug application', ['route' => 'app_drug_application_index']);
            $menu->addChild('Hospitalizations', ['route' => 'app_hospitalization_index']);
        }

        return $menu;
    }
}
<?php

namespace AppBundle\Menu;

use Knp\Menu\FactoryInterface;

class AppMenuBuilder
{
    /**
     * @var FactoryInterface
     */
    private $factory;

    /**
     * @param FactoryInterface $factory
     *
     * Add any other dependency you need
     */
    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    public function createAdminMenu(array $options)
    {
        $menu = $this->factory->createItem('root');

        $menu->addChild('Front', ['route' => 'app_patient_index']);
        $menu->addChild('Departments', ['route' => 'admin_department_index']);
        $menu->addChild('Drugs', ['route' => 'admin_drug_index']);
        $menu->addChild('Employees', ['route' => 'admin_employee_index']);
        $menu->addChild('Nurses', ['route' => 'admin_nurse_index']);
        // ... add more children

        return $menu;
    }

    public function createAppMenu(array $options)
    {
        $menu = $this->factory->createItem('root');

        $menu->addChild('Admin', ['route' => 'admin_department_index']);
        $menu->addChild('Patients', ['route' => 'app_patient_index']);
        $menu->addChild('Drugs', ['route' => 'app_drug_index']);

        // ... add more children

        return $menu;
    }
}
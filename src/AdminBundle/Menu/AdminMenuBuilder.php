<?php

namespace AdminBundle\Menu;

use Knp\Menu\FactoryInterface;

class AdminMenuBuilder
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

        $menu->addChild('Departments', ['route' => 'admin_department_index']);
        $menu->addChild('Drugs', ['route' => 'admin_drug_index']);
        $menu->addChild('Employees', ['route' => 'admin_employee_index']);
        // ... add more children

        return $menu;
    }
}
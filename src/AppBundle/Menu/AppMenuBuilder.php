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
            $menu->addChild('Uživatelská část', ['route' => 'app_patient_index']);
        }

        if ($this->user->isAdmin()) {
            $menu->addChild('Oddělení', ['route' => 'admin_department_index',]);
            $menu->addChild('Léky', ['route' => 'admin_drug_index']);
            $menu->addChild('Zaměstnanci', ['route' => 'admin_employee_index']);
        }

        return $menu;
    }

    public function createAppMenu(array $options)
    {
        $menu = $this->factory->createItem('root');

        if ($this->user->isAdmin()) {
            $menu->addChild('Admin část', ['route' => 'admin_department_index']);
        }

        if ($this->user->isDoctor() || $this->user->isNurse()) {
            $menu->addChild('Pacienti', ['route' => 'app_patient_index']);
            $menu->addChild('Léky', ['route' => 'app_drug_index']);
            $menu->addChild('Podání léku', ['route' => 'app_drug_application_index']);
            $menu->addChild('Hospitalizace', ['route' => 'app_hospitalization_index']);
            $menu->addChild('Oddělení', ['route' => 'app_department_index']);

        }

        return $menu;
    }
}
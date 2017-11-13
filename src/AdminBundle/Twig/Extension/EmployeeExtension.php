<?php

namespace AdminBundle\Twig\Extension;

use AppBundle\Entity\Employee;
use Symfony\Component\Routing\RouterInterface;
use Twig\TwigFunction;

class EmployeeExtension extends \Twig_Extension
{
    /** @var  RouterInterface */
    private $router;

    /**
     * EmployeeExtension constructor.
     *
     * @param RouterInterface $router
     */
    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }


    public function getFunctions()
    {
        return [
            new TwigFunction('getEmployeeShowUrl', [$this, 'getEmployeeShowUrl']),
            new TwigFunction('getEmployeeEditUrl', [$this, 'getEmployeeEditUrl']),
        ];
    }

    /**
     * @param Employee $employee
     * @return string
     * @throws \Symfony\Component\Routing\Exception\RouteNotFoundException
     * @throws \Symfony\Component\Routing\Exception\MissingMandatoryParametersException
     * @throws \Symfony\Component\Routing\Exception\InvalidParameterException
     */
    public function getEmployeeShowUrl(Employee $employee)
    {
        if ($employee->isAdmin()) {
            return $this->router->generate('admin_admin_show', ['id' => $employee->getId()]);
        } elseif ($employee->isNurse()) {
            return $this->router->generate('admin_nurse_show', ['id' => $employee->getId()]);
        } else {
            return $this->router->generate('admin_doctor_show', ['id' => $employee->getId()]);
        }
    }


    /**
     * @param Employee $employee
     * @return string
     * @throws \Symfony\Component\Routing\Exception\RouteNotFoundException
     * @throws \Symfony\Component\Routing\Exception\MissingMandatoryParametersException
     * @throws \Symfony\Component\Routing\Exception\InvalidParameterException
     */
    public function getEmployeeEditUrl(Employee $employee)
    {
        if ($employee->isAdmin()) {
            return $this->router->generate('admin_admin_edit', ['id' => $employee->getId()]);
        } elseif ($employee->isNurse()) {
            return $this->router->generate('admin_nurse_edit', ['id' => $employee->getId()]);
        } else {
            return $this->router->generate('admin_doctor_edit', ['id' => $employee->getId()]);
        }
    }


    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'employee';
    }
}

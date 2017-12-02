<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Doctor;
use AppBundle\Entity\Employee;
use AppBundle\Entity\Nurse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BaseAppController extends Controller
{
    public function addSuccessfullySavedFlash()
    {
        $this->addFlash('success', 'Úspěšně uloženo');
    }

    public function addSuccessFlash(string $message)
    {
        $this->addFlash('success', $message);
    }

    public function addErrorFlash(string $message)
    {
        $this->addFlash('error', $message);
    }

    /**
     * @return Doctor|Employee|Nurse|Employee
     */
    protected function getUser()
    {
        /** @var Employee $user */
        $user = parent::getUser();

        if ($user->isNurse() && !$user->isAdmin()) {
            return $this->getDoctrine()->getRepository(Nurse::class)->find($user->getId());
        } elseif ($user->isDoctor() && !$user->isAdmin()) {
            return $this->getDoctrine()->getRepository(Doctor::class)->find($user->getId());
        }

        return $user;
    }


}
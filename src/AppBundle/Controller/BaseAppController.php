<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Employee;
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

    protected function getUser()
    {
        /** @var Employee $user */
        $user = parent::getUser();

        if ($user->isNurse()) {

        }

        return $user;
    }


}
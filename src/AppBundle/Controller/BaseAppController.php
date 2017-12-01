<?php

namespace AppBundle\Controller;

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
}
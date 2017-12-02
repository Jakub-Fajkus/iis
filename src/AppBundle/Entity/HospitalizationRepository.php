<?php

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * HospitalizationRepository
 *
 */
class HospitalizationRepository extends EntityRepository
{
    /**
     * @param Department $department
     * @return Hospitalization[]
     */
    public function getAllHospitalizationsOn(Department $department)
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT h
                     FROM AppBundle:Hospitalization h 
                     WHERE h.department = :department AND h.dateTo is NULL
                      '
            )
            ->setParameter('department', $department->getId())
            ->getResult();
    }
}

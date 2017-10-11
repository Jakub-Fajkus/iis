<?php

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * PatientRepository
 */
class PatientRepository extends EntityRepository
{
    public function getMatching(string $param)
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT p 
                     FROM AppBundle:Patient p
                     WHERE p.name LIKE :param
                        OR p.surname LIKE :param
                        OR p.personalIdentificationNumber LIKE :param
                        OR p.street LIKE :param
                        OR p.houseNumber LIKE :param
                        OR p.city LIKE :param
                        OR p.zip LIKE :param
                        OR p.medicalIdentificationNumber LIKE :param
                        OR p.insuranceCompanyId = :intParam
                        OR p.gender LIKE :param
                     ORDER BY p.id ASC'
            )
            ->setParameter('param', '%'.$param.'%')
            ->setParameter('intParam', $param)
            ->getResult();
    }
}

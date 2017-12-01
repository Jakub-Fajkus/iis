<?php

namespace AppBundle\Form;

use AppBundle\Entity\Doctor;
use AppBundle\Entity\Nurse;
use AppBundle\Entity\Prescription;
use AppBundle\Transformer\EntityToNumberTransformer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Entity\DrugApplication;

class DrugApplicationType extends AbstractType
{
    /** @var  EntityManagerInterface */
    protected $entityManager;

    /**
     * PrescriptionType constructor.
     *
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    /**
     * {@inheritdoc}
     * @throws \Symfony\Component\Form\Exception\InvalidArgumentException
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $doctors = $this->entityManager->getRepository(Doctor::class)->findAll();
        $employees = array_merge($doctors, $this->entityManager->getRepository(Nurse::class)->findAll());

        $builder
            ->add('time', DateTimeType::class)
            ->add('appliedBy', ChoiceType::class, ['choices' => $employees, 'choice_label' => function ($value, $key) {
                return ($value->getFullName()) == ' ' ? $value->getUsername() : $value->getFullName();
            }])
            ->add('prescription', HiddenType::class, [
                'data' => $options['prescription'],
                'data_class' => null,
            ]);

        $builder->get('prescription')
            ->addModelTransformer(new EntityToNumberTransformer($this->entityManager, Prescription::class));
    }

    /**
     * {@inheritdoc}
     * @throws \Symfony\Component\OptionsResolver\Exception\AccessException
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => DrugApplication::class,
            'prescription' => null,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_drugapplication';
    }


}

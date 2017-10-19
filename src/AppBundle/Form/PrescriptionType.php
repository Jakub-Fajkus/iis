<?php

namespace AppBundle\Form;

use AppBundle\Entity\Drug;
use AppBundle\Entity\Examination;
use AppBundle\Entity\Prescription;
use AppBundle\Transformer\EntityToNumberTransformer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PrescriptionType extends AbstractType
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
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('drug', EntityType::class, ['class' => Drug::class, 'choice_label' => 'name'])
            ->add('delivery')//todo: add select list?
            ->add('amount')
            ->add('periodOfApplication')
            ->add('examination', HiddenType::class, [
                'data' => $options['examination'],
                'data_class' => null,
            ]);

        $builder->get('examination')
            ->addModelTransformer(new EntityToNumberTransformer($this->entityManager, Examination::class));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Prescription::class,
            'examination' => null,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_prescription';
    }


}

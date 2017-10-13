<?php

namespace AppBundle\Form;

use AppBundle\Entity\Drug;
use AppBundle\Entity\Examination;
use AppBundle\Entity\Prescription;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PrescriptionType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('periodOfApplication')
            ->add('delivery')
            ->add('amount')
            ->add('drug', EntityType::class, ['class' => Drug::class, 'choice_label' => 'name'])
            ->add('examination', EntityType::class, [
                'class' => Examination::class,
                'data' => $options['prescriptionEntity'],
                'attr' => ['class' => 'hidden'] //todo: obviously does not work, but this should not be visible to the user
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Prescription::class,
            'prescriptionEntity' => null,
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

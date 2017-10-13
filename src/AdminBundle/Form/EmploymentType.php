<?php

namespace AdminBundle\Form;

use AppBundle\Entity\Department;
use AppBundle\Entity\Employment;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * {@inheritDoc}
 */
class EmploymentType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type') //todo: wtf???
            ->add('dateFrom')
            ->add('dateTo')
            ->add('department', EntityType::class, [
                'class' => Department::class,
                'choice_label' => function (Department $department) {
                    return $department->getShortcut();
                }
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Employment::class,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_employment';
    }


}

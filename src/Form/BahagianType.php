<?php

namespace App\Form;

use App\Entity\Bahagian;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BahagianType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('permission', EntityType::class, [
                'class' => Permission::class,
                'choice_label' => 'name',
            ])
            ->add('permission', ChoiceType::class, [
                'class' => Bahagian::class,
                'choice_label' => 'name',
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Bahagian::class,
        ]);
    }
}

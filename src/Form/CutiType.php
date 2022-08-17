<?php

namespace App\Form;

use App\Entity\Cuti;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Validator\Constraints\Choice;
use Craue\FormFlowBundle\Form\FormFlow;
use Craue\FormFlowBundle\Form\FormFlowInterface;

class CutiType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Nama')
            ->add('NomborStaff')
            ->add('tarikhMulaCuti', DateType::class, [
                'widget' => 'single_text',
                'input'  => 'datetime'])
            ->add('tarikhAkhirCuti', DateType::class, [
                'widget' => 'single_text',
                'input'  => 'datetime'])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Cuti::class,
        ]);
    }
}

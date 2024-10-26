<?php

namespace App\Form;

use App\Entity\Appartment;
use App\Entity\Booking;
use App\Entity\Owner;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AppartmentsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('appartementId')
            ->add('type')
            ->add('numberOfrooms')
            ->add('squareMeters')
            ->add('adresse')
            ->add('price')
            ->add('owner', EntityType::class, [
                'class' => Owner::class,
                'choice_label' => 'id',
            ])
            ->add('booking', EntityType::class, [
                'class' => Booking::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Appartment::class,
        ]);
    }
}

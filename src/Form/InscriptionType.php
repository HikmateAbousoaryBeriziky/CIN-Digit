<?php

namespace App\Form;

use App\Entity\Utilisateur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class InscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('prenoms')
            ->add('dateDeNaissance',DateType::class,[
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd'
            ])
            ->add('lieuDeNaissance')
            ->add('domicile')
            ->add('arrondissement')
            ->add('profession')
            ->add('pere')
            ->add('mere')
            ->add('lieuDeDelivrance')
            ->add('dateDeDelivrance',DateType::class,[
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd'
            ])
            ->add('image',FileType::class,[
                'mapped' => false,
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Utilisateur::class,
        ]);
    }
}

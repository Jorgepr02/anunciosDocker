<?php

namespace App\Form;

use App\Entity\Anuncio;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AnuncioFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomeAnuncio')
            ->add('descricion')
            ->add('dataPublicacion', null, [
                'widget' => 'single_text',
            ])
            ->add('dataVenta', null, [
                'widget' => 'single_text',
            ])
            ->add('vendido')
            ->add('prezoInicial')
            ->add('prezoFinal')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Anuncio::class,
        ]);
    }
}

<?php

namespace App\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, ['label'    => 'Imię:'])
            ->add('surname', TextType::class, ['label'    => 'Nazwisko:'])
            ->add('age' , IntegerType::class, ['label'    => 'Wiek:', 'attr' => ['min' => 18, 'max' => 99]])
            ->add('email', EmailType::class, ['label'    => 'Email:'])
            ->add('consent', CheckboxType::class, ['label'    => 'Zgoda na przetważanie danych osobowych.'])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}

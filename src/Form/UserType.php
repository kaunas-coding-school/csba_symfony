<?php

namespace App\Form;

use App\Entity\Person;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email')
//            ->add('roles', ChoiceType::class, [
//                'choices'  => [
//                    'Admin' => 'ROLE_ADMIN',
//                    'User' => 'ROLE_USER',
//                    'Manager' => 'ROLE_MANAGER',
//                ]])
            ->add('password')
            ->add('person', PersonType::class)
//            ->add('person', EntityType::class, ['class' => Person::class, 'choice_label' => 'name'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}

<?php

namespace App\Form;

use App\Entity\Employee;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class EmployeeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName', TextType::class, [
                'constraints' => [new Assert\NotBlank(['message' => 'First name is required.'])]
            ])
            ->add('lastName', TextType::class, [
                'constraints' => [new Assert\NotBlank(['message' => 'Last name is required.'])]
            ])
            ->add('age', NumberType::class, [
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Age is required.']),
                    new Assert\Range(['min' => 18, 'max' => 65, 'notInRangeMessage' => 'Age must be between 18 and 65.'])
                ]
            ])
            ->add('email', EmailType::class, [
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Email is required.']),
                    new Assert\Email(['message' => 'Invalid email format.'])
                ]
            ])
            ->add('submit', SubmitType::class, ['label' => 'Save Employee']);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Employee::class,
        ]);
    }
}

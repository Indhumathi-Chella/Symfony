<?php 

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
    $builder
    ->add('name', TextType::class, [
        'label' => 'Your Name',
        'attr' => ['id' => 'user_name', 'name' => 'user_name']
    ])
    ->add('email', EmailType::class, [
        'label' => 'Your Email',
        'attr' => ['id' => 'user_email', 'name' => 'user_email']
    ])
    ->add('submit', SubmitType::class, [
        'label' => 'Submit'
    ]);

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class, // Ensure this matches your entity
        ]);
    }
}

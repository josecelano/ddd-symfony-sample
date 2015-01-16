<?php

namespace Matthias\User\Presentation\Infrastructure\WebBundle\Form;

use Matthias\User\App\Command\RegisterUserCommand;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RegisterUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username')
            ->add('password')
            ->add('register', 'submit');
    }

    public function getName()
    {
        return 'user_web_bundle_register_user';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Matthias\User\App\Command\RegisterUserCommand',
            'empty_data' => function (FormInterface $form) {
                $command = new RegisterUserCommand(
                    $form->get('username')->getData(),
                    $form->get('password')->getData()
                );
                return $command;
            },
        ));
    }
}
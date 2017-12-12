<?php
/**
 * User: idulevich
 */

namespace TestTaskBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use TestTaskBundle\Entity\User;

/**
 * Class UserEditFormType
 */
class UserEditFormType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', TextType::class, [
            'label' => 'Имя',
            'required' => true,
        ]);

        $builder->add('email', TextType::class, [
            'label' => 'Email',
            'required' => true,
        ]);

        $builder->add('address', TextType::class, [
            'label' => 'Адрес',
            'required' => true,
        ]);

        $builder->add('submit', SubmitType::class, [
            'label' => 'Добавить'
        ]);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => User::class,
        ));
    }

    /**
     * @return string
     */
    public function getBlockPrefix()
    {
        return 'ttb_user_edit';
    }
}
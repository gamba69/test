<?php
/**
 * User: idulevich
 */

namespace TestTaskBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use TestTaskBundle\Entity\Account;

/**
 * Class AccountEditFormType
 * @package TestTaskBundle\Form
 */
class AccountEditFormType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('account', IntegerType::class, [
            'label' => 'Счет',
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
            'data_class' => Account::class,
        ));
    }

    /**
     * @return string
     */
    public function getBlockPrefix()
    {
        return 'ttb_account_edit';
    }
}
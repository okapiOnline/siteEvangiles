<?php

namespace Meupf\UserBundle\Form\Type;

use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistrationFormType extends BaseType
{


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $car_choices = array(
            'Swedish Cars' => array(
                'volvo' => 'Volvo',
                'saab' => 'Saab',
            ),
            'German Cars' => array(
                'mercedes' => 'Mercedes',
                'audi' => 'Audi'
            ));

        parent::buildForm($builder, $options);
        // Ajoutez vos champs ici
        $builder->add('phone')
                ->add('enabled', 'checkbox', array('required' => false))
                ->add('roles', CollectionType::class, array(
                    'type'   => 'choice',
                    'options'  => array(
                        'choices'  => array(
                            'ROLE_ADMIN'  => 'ADMINISTRATEUR',
                            'ROLE_AUTEUR' => 'AUTEUR',
                        ),
                    ),
                ))
                ->add('Enregistrer', 'submit')
        ;
    }


    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Meupf\UserBundle\Entity\User'
        ));
    }


    public function getName()
    {
        return 'meupf_user_registration';
    }
}

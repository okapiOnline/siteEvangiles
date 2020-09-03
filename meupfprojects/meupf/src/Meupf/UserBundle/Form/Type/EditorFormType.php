<?php
/**
 * Created by PhpStorm.
 * User: becom
 * Date: 19/05/2016
 * Time: 14:15
 */

namespace Meupf\UserBundle\Form\Type;

use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EditorFormType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
       // parent::buildForm($builder, $options);
        // Ajoutez vos champs ici
        $builder->add('phone')
            ->add('username')
            ->add('email')
            ->remove('plainPassword')

            ->add('roles', 'collection', array(
                'type'   => 'choice',
                'options'  => array(
                    'choices'  => array(
                        'ROLE_ADMIN' => 'ADMINISTRATEUR',
                        'ROLE_AUTEUR'    => 'AUTEUR',
                    ),
                ),
            ))

            ->add('enabled', 'checkbox', array('required' => false))
            ->add('Sauvegarder', 'submit');
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

    
} 
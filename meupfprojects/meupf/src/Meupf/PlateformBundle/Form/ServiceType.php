<?php

namespace Meupf\PlateformBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ServiceType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', 'text', array('label' => 'Titre'))
            ->add('online', 'checkbox', array('required' => false))
            ->remove('slug')
            ->add('content', 'ckeditor', array (
                'label'             => 'Contenu',
                'config_name'       => 'my_custom_config',
                'config' => array(
                    'language'    => 'fr'
                ),
            ))
            ->remove('createdAt', 'datetime')
            ->add('Sauvegarder', 'submit')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Meupf\PlateformBundle\Entity\Service'
        ));
    }
}

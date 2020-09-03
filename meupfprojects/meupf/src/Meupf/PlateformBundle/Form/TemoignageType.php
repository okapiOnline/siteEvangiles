<?php

namespace Meupf\PlateformBundle\Form;

use FM\ElfinderBundle\Form\Type\ElFinderType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TemoignageType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('lastname')
            ->add('subject')
            ->add('message', 'ckeditor', array (
                'label'             => 'Contenu',
                'config_name'       => 'my_custom_config',
                'config' => array(
                    'language'    => 'fr'
                ),
            ))
            ->add('online', 'checkbox', array('required' => false))
            ->remove('createdAt', 'datetime')
            ->add('image', ElFinderType::class, array('instance'=>'form', 'enable'=>true))
            ->add('Sauvegarder', 'submit');

    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Meupf\PlateformBundle\Entity\Temoignage'
        ));
    }
}

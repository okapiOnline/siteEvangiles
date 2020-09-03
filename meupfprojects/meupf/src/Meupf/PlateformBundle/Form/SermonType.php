<?php

namespace Meupf\PlateformBundle\Form;

use FM\ElfinderBundle\Form\Type\ElFinderType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SermonType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', 'text', array('label' => 'titre'))
            ->add('categorie', 'entity', array(
                'class'    => 'MeupfPlateformBundle:CategorieSermon',
                'property' => 'name',
                'multiple' => false
            ))
            ->add('content', 'ckeditor', array (
                'label'             => 'Contenu',
                'config_name'       => 'my_custom_config',
                'config' => array(
                    'language'    => 'fr'
                ),
            ))
            ->add('online', 'checkbox', array('required' => false))
            ->add('image', ElFinderType::class, array('instance'=>'form', 'enable'=>true))
            ->add('Sauvegarder', 'submit')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Meupf\PlateformBundle\Entity\Sermon'
        ));
    }
}

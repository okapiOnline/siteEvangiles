<?php

namespace Meupf\PlateformBundle\Form;

use FM\ElfinderBundle\Form\Type\ElFinderType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;



class EventType extends AbstractType
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
                'class' => 'MeupfPlateformBundle:CategorieEvent',
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
            ->add('lieu', 'text', array('label' => 'Lieu'))
            ->add('date', 'date', array('format' => 'dd/MM/yyyy', 'widget' => 'single_text', 'input' => 'datetime'))
            ->add('heureDebut', 'time', array('widget' => 'single_text', 'input' => 'datetime'))
            ->add('heureFin', 'time', array('widget' => 'single_text', 'input' => 'datetime'))
            ->add('phone', 'text', array('label' => 'Téléphone'))
            ->add('online', 'checkbox', array('required' => false))
            ->add('image', ElFinderType::class, array('instance' => 'form', 'enable' => true))
            ->add('Sauvegarder', 'submit')
        ;

    }


    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Meupf\PlateformBundle\Entity\Event'
        ));
    }
}
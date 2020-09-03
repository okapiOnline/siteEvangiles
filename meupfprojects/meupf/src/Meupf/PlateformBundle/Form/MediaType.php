<?php

namespace Meupf\PlateformBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MediaType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', 'text', array('label' => 'Titre'))
            ->add('categorie', 'entity', array(
                'class'    => 'MeupfPlateformBundle:CategorieMedia',
                'property' => 'name',
                'multiple' => false
            ))
            ->add('url', 'text', array('label' => 'Lien de la video'))
            ->add('type', 'text', array('label' => 'Type'))
            ->add('description', 'textarea', array('label' => 'Description'))
            ->remove('slug')
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
            'data_class' => 'Meupf\PlateformBundle\Entity\Media'
        ));
    }
}

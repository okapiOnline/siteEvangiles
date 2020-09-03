<?php

namespace Meupf\PlateformBundle\Form;

use FM\ElfinderBundle\Form\Type\ElFinderType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GalleryType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('description', 'textarea')
            ->add('image', ElFinderType::class, array('instance'=>'form', 'enable'=>true))
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
            'data_class' => 'Meupf\PlateformBundle\Entity\Gallery'
        ));
    }
}

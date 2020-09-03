<?php

namespace Meupf\PlateformBundle\Form;

use FM\ElfinderBundle\Form\Type\ElFinderType;
use Meupf\PlateformBundle\Entity\Image;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SliderType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', 'text', array('label' => 'titre'))
            ->add('online', 'checkbox', array('required' => false))
            ->add('image', ElFinderType::class, array('instance'=>'form', 'enable'=>true))
           // ->add('image', new ImageType())
            ->add('Sauvegarder', 'submit')
        ;
    }


    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Meupf\PlateformBundle\Entity\Slider'
        ));
    }
}

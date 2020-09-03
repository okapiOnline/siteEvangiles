<?php

namespace Meupf\PlateformBundle\Form;

use FM\ElfinderBundle\Form\Type\ElFinderType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ResponsableType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', array('label' => 'Nom'))
            ->add('lastname', 'text', array('label' => 'Prenom'))
            ->add('image', ElFinderType::class, array('instance'=>'form', 'enable'=>true))
            ->add('description', 'textarea', array('label' => 'Description', 'attr'=>array('cols' => 200, 'rows' => 10)))
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
            'data_class' => 'Meupf\PlateformBundle\Entity\Responsable'
        ));
    }
}

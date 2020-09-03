<?php

namespace Meupf\PlateformBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommentType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('user', 'text', array('attr' => array('class' => 'form-control input-lg', 'placeholder' => 'Votre nom')))
            ->add('comment', 'textarea', array('attr' => array('cols' => 8, 'rows' => 4,'class' => 'form-control input-lg', 'placeholder' => 'Your comment')))
            ->add('Soumettre', 'submit')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Meupf\PlateformBundle\Entity\Comment'
        ));
    }
}

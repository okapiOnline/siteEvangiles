<?php

namespace Meupf\PlateformBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategorieEventType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', array('label' => 'Titre'))
            ->remove('createdAt', 'datetime')
            ->remove('postCount')
            ->remove('slug')
            ->remove('updatedAt', 'datetime')
            ->add('Sauvegarder', 'submit')
            //->setAction($this->generateUrl('meupf_plateform_add'))
           // ->add('ajouter', 'submit', array('label' => 'Ajouter'))

        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Meupf\PlateformBundle\Entity\CategorieEvent'
        ));
    }
}

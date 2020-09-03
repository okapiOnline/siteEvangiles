<?php

namespace Meupf\PlateformBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use FM\ElfinderBundle\Form\Type\ElFinderType;

class ArticleType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title',     'text', array('label' => 'titre'))
            ->add('categorie', 'entity', array(
                    'class'    => 'MeupfPlateformBundle:CategorieArticle',
                    'property' => 'name',
                    'multiple' => false
                ))
            //->add('content',   'textarea', array('attr' => array('class' => 'ckeditor')), array('label' => 'contenue'))
            ->add('content', 'ckeditor', array (
                'label'             => 'Contenu',
                'config_name'       => 'my_custom_config',
                'config' => array(
                    'language'    => 'fr'
                ),
            ))
           // ->add('image',   new ImageType())
           ->add('image', ElFinderType::class, array('instance'=>'form', 'enable'=>true))
            ->add('online', 'checkbox', array('required' => false))
            ->add('Sauvegarder',      'submit');

        // On ajoute une fonction qui va écouter l'évènement PRE_SET_DATA
        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function(FormEvent $event) {
                // On récupère notre objet Advert sous-jacent
                $article = $event->getData();

                if (null === $article) {
                    return;
                }

                if ($article->getOnline() || null === $article->getId()) {
                    $event->getForm()->add('online', 'checkbox', array('required' => false));
                } else {
                    $event->getForm()->remove('online');
                }
            }
        );
    }

    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Meupf\PlateformBundle\Entity\Article'
        ));
    }

    /**

     * @return string

     */

    public function getName()
    {
        return 'meupf_plateformbundle_article';
    }

}

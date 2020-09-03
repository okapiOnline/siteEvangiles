installation avec composer :
$ composer create-project symfony/framework-standard-edition meupf "2.8.*"

generation du bundle
php app/console generate:bundle

loc

Notre plateforme

La plateforme que nous allons créer est très simple. En voici les grandes lignes :

    Nous aurons des annonces (advert en anglais) de mission : développement d'un site internet, création d'une maquette, intégration HTML, etc. ;

    Nous pourrons lire, écrire, éditer et rechercher des annonces ;

    À chaque annonce, nous pourrons lier une image d'illustration ;

    À chaque annonce, nous pourrons lier plusieurs candidatures (application en anglais) ;

    Nous aurons plusieurs catégories (Développement, Graphisme, etc.) qui seront liées aux annonces. Nous pourrons créer, modifier et supprimer ces catégories ;

    À chaque annonce, nous pourrons enfin lier des niveaux de compétence requis (Expert en PHP, maîtrise de Photoshop, etc.).


    php app/console cache:clear --env=prod
    php app/console cache:clear

    Au début, nous n'aurons pas de système de gestion des utilisateurs : nous devrons saisir notre nom lorsque nous rédigerons une annonce. Puis, nous rajouterons la couche utilisateur.

Un peu de nettoyage

pour generer un entité
---------------------

php app/console generate:doctrine:entity

cree une db avec doctrine
php app/console doctrine:database:create

generation des tables dans la db
php app/console doctrine:schema:update --dump-sql

execution de la requete
php app/console doctrine:schema:update --force

generer un formulaire
php app/console doctrine:generate:form MeupfPlateformBundle:Article



utilisation du bundle SensioFrameworkExtraBundle
pour la securité

pour executer la class Userload une classe qui implement fixture
php app/console doctrine:fixtures:load

cmd fosUserBundle
    php app/console fos:user:create

  debug route
  php app/console router:debug



  ajouter une extension truncate ou wordwrap à symfony
  composer require twig/extensions

  puis rajouter dans app/config.yml
   services:
                    twig.extension.text:
                       class: Twig_Extensions_Extension_Text
                       tags:
                            - { name: twig.extension }


localizeddate('full', 'none')


installation du bundle IvoryCkEditorBundle
puis installer les assetic  php app/console assets:install web


installation du gestionnaire de fichier fmelfinderBundle
"config": {
        "bin-dir": "bin",
        "component-dir": "web/assets"
    }, dans le fichier composer
composer update helios-ag/fm-elfinder-bundle


!!!!ERREUR A GERER L'ADRESSE EMAIL EST DEJA UTILISE !!!!

 $car_choices = array(
            'Swedish Cars' => array(
                'volvo' => 'Volvo',
                'saab' => 'Saab',
            ),
            'German Cars' => array(
                'mercedes' => 'Mercedes',
                'audi' => 'Audi'
            ));
            
             ->add('roles', 'choice', array(
                            'label' => 'Choose your car',
                            'choices' => $car_choices,
                        ))
                        
 src="http://player.vimeo.com/video/19564018?title=0&amp;byline=0&amp;color=007F7B"
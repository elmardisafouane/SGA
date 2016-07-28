# SGA

Web site for Absence Management

Site web pour la gestion des absences avec Symfony 3

Pour voir une vidéo de démonstration sur youtube : https://www.youtube.com/watch?v=L1ijHI4FGhc


#Installation


##1. Récupérer le code

Veullez telecharger le code source du site web.

##2. Téléchargement des vendors

avec Composer  :
php composer.phar install

##3. Créez la base de données

php bin/console doctrine:database:create

Puis créez les tables correspondantes au schéma Doctrine :
php bin/console doctrine:schema:update --dump-sql
php bin/console doctrine:schema:update --force

Ajoutez les fixtures :
php bin/console doctrine:fixtures:load

##4. Publiez les assets

Publiez les assets dans le répertoire web :
php bin/console assets:install web


Et profitez du site web !

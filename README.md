#  [PROJET] Première version d'un projet d'API REST destinée à l'exploitation de données depuis une BDD, en se basant sur un modèle type MVC

Le projet a été entièrement réalisé en PHP, combiné au framework [Medoo](https://medoo.in/).

## Bases du projet

Le projet étant un exercice proposé dans le cadre d'une formation développeur web / web mobile, il n'a aucune vocation à être utilisé d'autre manière qu'à des fins purement éducatives. Celui-ci fait simplement office de démonstration et ne sera pas utilisé ailleurs.

**Le projet visant à exploiter le modèle MVC, celui-ci est léger et comprend :**
- L'utilisation d'un framework PHP ([Medoo](https://medoo.in/)), sa mise en place et sa configuration.
- L'écriture d'un système d'API RESTful permettant de récupérer des données sous un format JSON en fonction de l'URL.
- La mise à jour de données présentes dans la BDD directement depuis un JSON envoyé en body avec des paramètres.
- Gestion des erreurs potentielles en cas de mauvaise utilisation.

## Utilisation

L'utilisation de cette API reste assez simple, il suffit de vous placer dans le dossier de votre choix et de cloner le projet depuis GitHub :

    git clone https://github.com/Thomaslrt/mvc_api_v1
    
Une fois cloné, ouvrez le fichier ```Model.class.php``` et modifiez la ligne avec les identifiants de votre base de données :

```
private static function initDatabase(){
       self::$database = new Medoo\Medoo([
           'database_type' => 'mysql',
           'database_name' => self::DB,
           'server' => self::HOST,
           'username' => self::USER,
           'password' => self::PWD,
           "charset" => "utf8",
           PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
       ]);
    }
```
Il vous faut aussi importer le fichier ```database.sql``` présent à la racine, afin d'avoir les bonnes tables de disponible, et faire la liaison avec le projet.


## À propos de moi
- [Mes projets sur GitHub](https://github.com/Thomaslrt) 
- [Mon site](https://thomaslrt.fr/) 
- [Mon LinkedIn](https://www.linkedin.com/in/thomas-laurent-432271173/)

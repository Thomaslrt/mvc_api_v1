<?php
class Ville extends Model
{
    private $id;
    private $departement;
    private $nom;
    private $code_postal;
    private $canton;
    private $population;
    private $densite;
    private $surface;

    public function __construct($id, $departement, $nom, $code_postal, $canton, $population, $densite, $surface)
    {
        $this->id = $id ;
        $this->departement = $departement ;
        $this->nom = $nom ;
        $this->code_postal = $code_postal;
        $this->canton = $canton;
        $this->population = $population;
        $this->densite = $densite;
        $this->surface = $surface;
    }

    public function __get($property) {
        if (property_exists($this, $property)) {
        return $this->$property;
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function setDepartement($departement)
    {
        $this->departement = $departement;
    }

    public function getDepartement()
    {
        return $this->departement;
    }

    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function setCodePostal($code_postal)
    {
        $this->code_postal = $code_postal;
    }
    

    public function getCodePostal()
    {
        return $this->code_postal;
    }
    
     public function setCanton($canton)
    {
        $this->canton = $canton;
    }

    public function getCanton()
    {
        return $this->canton;
    }

     public function setPopulation($population)
    {
        $this->population = $population;
    }

    public function getPopulation()
    {
        return $this->population;
    }

     public function setDensite($densite)
    {
        $this->densite = $densite;
    }

    public function getDensite()
    {
        return $this->densite;
    }

     public function setSurface($surface)
    {
        $this->surface = $surface;
    }

    public function getSurface()
    {
        return $this->surface;
    }
}
<?php

namespace Models;

use DateTime;
use Models\DB;
use PDO;
use PDOException;

include "DB.php";
class Team
{
    private int $id;
    private string $name;
    private string $city;
    private string $sport;
    private string $yearOfFoundation;
    private DateTime $createdAt;
    private string $slug;

    private string $table = 'team';

    public function __construct(?int $id = null)
    {
        if(!is_null($id)) {
            $this->getById($id);
        }
    }

    public function fill(array $params): void{
        $this->validate($params);
        $this->name = $params['name'];
        $this->sport = $params['sport'];
        $this->yearOfFoundation = $params['year_of_foundation'];
        $this->city = $params['city'];
        $this->slug = strtolower(str_replace([' ', '.'], '-', $this->name));
        $this->createdAt = new DateTime();
    }

    public function insert(): void{
        try {
            $db = DB::connect();
            $query = "INSERT INTO ".$this->table." (name, sport, city, year_of_foundation, slug, created_at) VALUES (:name, :sport, :city, :year_of_foundation, :slug, :created_at)";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':sport', $this->sport);
            $stmt->bindParam(':city', $this->city);
            $stmt->bindParam(':year_of_foundation', $this->yearOfFoundation);
            $stmt->bindParam(':slug', $this->slug);
            $createdAt = $this->createdAt->format('Y-m-d H:i:s');
            $stmt->bindParam(':created_at', $createdAt);
            $stmt->execute();

        }catch (PDOException $e){
            error_log("[".date('d/m/Y H:i:s') . "]" . $e->getMessage() ."\n", 3, __DIR__ . '/../error.log');
            throw new \Exception("Error al dar de alta el equipo en la base de datos.");
        }

    }

    public function update(){
        $db = DB::connect();
        $query = "UPDATE ".$this->table." SET name = :name, sport = :sport, slug = :slug, city = :city, year_of_foundation = :year_of_foundation WHERE id = :id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':sport', $this->sport);
        $stmt->bindParam(':slug', $this->slug);
        $stmt->bindParam(':city', $this->city);
        $stmt->bindParam(':year_of_foundation', $this->yearOfFoundation);
        if(!$stmt->execute()){
            throw new \Exception("No se ha podido actualizar la información del equipo.");
        }
    }

    public function delete(){
        $db = DB::connect();
        $query = "DELETE FROM ".$this->table." WHERE id = :id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        if(!$stmt->execute()){
            throw new \Exception("No se ha podido eliminar el equipo seleccionado.");
        }
    }

    public function getAll(): array{
        $db = DB::connect();
        $query = "SELECT * FROM ".$this->table." ORDER BY created_at DESC";
        $stmt = $db->query($query);
        $result = [];
        foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $item){
            $team = new Team();
            $team->fillFromDb($item);
            $result[] = $team;
        }
        return $result;
    }

    public function getBySport(string $sport): array{
        $db = DB::connect();
        $query = "SELECT * FROM ".$this->table." WHERE sport = :sport ORDER BY created_at DESC";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':sport', $sport);
        $stmt->execute();
        $result = [];
        foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $item){
            $team = new Team();
            $team->fillFromDb($item);
            $result[] = $team;
        }
        return $result;
    }

    public function findBySlug(string $slug): void{
        $db = DB::connect();
        $query = "SELECT * FROM ".$this->table." WHERE slug = :slug";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':slug', $slug);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if($result){
            $this->fillFromDb($result);
        }else{
            throw new \Exception("No se ha encontrado el equipo seleccionado en la base de datos.");
        }
    }

    private function getById(int $id): void{
        $db = DB::connect();
        $query = "SELECT * FROM ".$this->table." WHERE id = :id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if($result){
            $this->fillFromDb($result);
        }else{
            throw new \Exception("No se ha encontrado el equipo seleccionado en la base de datos.");
        }

    }

    private function fillFromDb(array $params): void{
        $this->id = $params['id'];
        $this->name = $params['name'];
        $this->sport = $params['sport'];
        $this->createdAt = (new DateTime($params['created_at']));
        $this->yearOfFoundation = $params['year_of_foundation'];
        $this->slug = $params['slug'];
        $this->city = $params['city'];
    }
    private function validate(array $params): void{
        $errors = [];
        if(empty($params['name'])){
            $errors['name'] = 'El campo nombre no puede estar vacío.';
        }

        if(empty($params['sport'])){
            $errors['sport'] = 'Debe seleccionar una opción para el campo deporte.';
        }

        if(empty($params['city'])){
            $errors['city'] = 'El campo ciudad no puede estar vacío';
        }

        if(empty($params['year_of_foundation'])){
            $errors['year_of_foundation'] = 'El campo fecha de fundación no puede estar vacío';
        }else{
            $yearOfFoundation = new DateTime($params['year_of_foundation']);
            $currentDate = new DateTime();
            if($yearOfFoundation > $currentDate){
                $errors['year_of_foundation'] = 'El campo fecha de fundación no puede ser superior a la fecha actual.';
            }
        }

        if(!empty($errors)){
            throw new \Exception(serialize($errors));
        }
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function setCity(string $city): void
    {
        $this->city = $city;
    }

    public function getSport(): string
    {
        return $this->sport;
    }

    public function setSport(string $sport): void
    {
        $this->sport = $sport;
    }

    public function getYearOfFoundation(): string
    {
        return $this->yearOfFoundation;
    }

    public function setYearOfFoundation(string $yearOfFoundation): void
    {
        $this->yearOfFoundation = $yearOfFoundation;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
    }


}
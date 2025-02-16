<?php

namespace Models;

use DateTime;
use PDO;
use PDOException;

class Player
{
    private int $id;
    private int $team_id;
    private string $name;
    private string $surname;
    private string $number;
    private string $birth;
    private int $captain;

    private string $table = 'player';

    public function __construct(?int $id = null)
    {
        if(!is_null($id)) {
            $this->getById($id);
        }
    }

    public function insert(): void{
        try {
            $db = DB::connect();
            $query = "INSERT INTO ".$this->table." (team_id, name, surname, birth, captain, number) VALUES (:team_id, :name, :surname, :birth, :captain, :number)";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':team_id', $this->team_id);
            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':surname', $this->surname);
            $stmt->bindParam(':birth', $this->birth);
            $stmt->bindParam(':captain', $this->captain);
            $stmt->bindParam(':number', $this->number);
            $stmt->execute();

        }catch (PDOException $e){
            error_log("[".date('d/m/Y H:i:s') . "]" . $e->getMessage() ."\n", 3, __DIR__ . '/../error.log');
            throw new \Exception("Error al dar de alta un jugador en la base de datos.");
        }

    }

    public function fill(array $params): void{
        $this->validate($params);
        $this->name = $params['name'];
        $this->surname = $params['surname'];
        $this->birth = $params['birth'];
        $this->number = $params['number'];
        $this->team_id = $params['team_id'];
        if(isset($params['captain'])){
            $this->captain = 1;
        }else{
            $this->captain = 0;
        }
    }

    public function delete(){
        $db = DB::connect();
        $query = "DELETE FROM ".$this->table." WHERE id = :id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id', $this->id);
        if(!$stmt->execute()){
            throw new \Exception("No se ha podido eliminar el jugador seleccionado.");
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
            throw new \Exception("No se ha podido eliminar el jugador seleccionado.");
        }

    }

    private function validate(array $params): void{
        $errors = [];
        if(empty($params['name'])){
            $errors['name'] = 'El campo nombre no puede estar vacío.';
        }

        if(empty($params['surname'])){
            $errors['surname'] = 'El campo apellidos no puede estar vacío.';
        }

        if(empty($params['number'])){
            $errors['number'] = 'El campo dorsal no puede estar vacío';
        }

        if(empty($params['birth'])){
            $errors['birth'] = 'El campo fecha de fundación no puede estar vacío';
        }else{
            $yearOfFoundation = new DateTime($params['birth']);
            $currentDate = new DateTime();
            if($yearOfFoundation > $currentDate){
                $errors['birth'] = 'El campo fecha de nacimiento no puede ser superior a la fecha actual.';
            }
        }

        if(!empty($errors)){
            throw new \Exception(serialize($errors));
        }
    }

    public function fillFromDb(array $params): void{
        $this->id = $params['id'];
        $this->team_id = $params['team_id'];
        $this->name = $params['name'];
        $this->surname = $params['surname'];
        $this->birth = $params['birth'];
        $this->number = $params['number'];
        $this->captain = $params['captain'];
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getTeamId(): int
    {
        return $this->team_id;
    }

    public function setTeamId(int $team_id): void
    {
        $this->team_id = $team_id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getSurname(): string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): void
    {
        $this->surname = $surname;
    }

    public function getNumber(): string
    {
        return $this->number;
    }

    public function setNumber(string $number): void
    {
        $this->number = $number;
    }

    public function getBirth(): string
    {
        return $this->birth;
    }

    public function setBirth(string $birth): void
    {
        $this->birth = $birth;
    }

    public function getCaptain(): string
    {
        return $this->captain;
    }

    public function setCaptain(string $captain): void
    {
        $this->captain = $captain;
    }
}
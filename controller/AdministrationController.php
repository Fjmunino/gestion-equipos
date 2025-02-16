<?php

namespace Controller;
use DateTime;
use Models\Team;
use Models\Player;

include "model/Team.php";
include "model/Player.php";
class AdministrationController
{
    public function index(){
        if(isset($_SESSION['successMessage'])){
            $successMessage = $_SESSION['successMessage'];
            unset($_SESSION['successMessage']);
        }

        if(isset($_SESSION['errorValidation'])){
            $errorValidation = $_SESSION['errorValidation'];
            unset($_SESSION['errorValidation']);
        }


        $teamModel = new Team();
        $teams = $teamModel->getAll();
        include __DIR__.'/../view/administration.php';
        exit;
    }

    public function createTeam(){
        if(isset($_SESSION['errorValidation'])){
            $errorValidation = unserialize($_SESSION['errorValidation']);
            unset($_SESSION['errorValidation']);
        }
        include __DIR__.'/../view/administration/createTeam.php';
        exit;
    }

    public function createTeamPost(){
        try{
            $team = new Team();
            $team->fill($_POST);
            $team->insert();
            $_SESSION['successMessage'] = "El equipo ha sido dado de alta correctamente";
            header("Location: /gestion-equipos/administration");
        }catch (\Exception $e){
            $_SESSION['errorValidation'] = $e->getMessage();
            error_log("[".date('d/m/Y H:i:s') . "]" . $e->getMessage() ."\n", 3, __DIR__ . '/../error.log');
            header("Location: /gestion-equipos/administration/create-team");
            exit;
        }finally{
            exit;
        }
    }

    public function editTeam(int $id){
        if(isset($_SESSION['successMessage'])){
            $successMessage = $_SESSION['successMessage'];
            unset($_SESSION['successMessage']);
        }

        if(isset($_SESSION['errorValidation'])){
            $errorValidation = unserialize($_SESSION['errorValidation']);
            unset($_SESSION['errorValidation']);
        }

        try{
            $team = new Team($id);
            $team->setYearOfFoundation((new DateTime($team->getYearOfFoundation()))->format('Y-m-d'));
            $players = $team->getPlayers();
            include __DIR__.'/../view/administration/editTeam.php';
        }catch (\Exception $e){
            $_SESSION['errorValidation'] = "Error al recuperar la información del equipo seleccionado.";
            error_log("[".date('d/m/Y H:i:s') . "]" . $e->getMessage() ."\n", 3, __DIR__ . '/../error.log');
            header("Location: /gestion-equipos/administration");
            exit;
        }
    }

    public function updateTeam(int $teamId){
        if($_SERVER["REQUEST_METHOD"] !== "POST"){
            header("Location: /gestion-equipos/administration/edit-team/".$teamId);
        }
        try{
            $team = new Team($teamId);
            if(is_null($team->getId())){
                throw new \Exception("El equipo al que se intenta acceder no existe");
            }
            $team->fill($_POST);
            $team->update();
            $_SESSION['successMessage'] = "La información del equipo ha sido actualizada correctamente.";
        }catch (\Exception $e){
            $_SESSION['errorValidation'] = $e->getMessage();
            error_log("[".date('d/m/Y H:i:s') . "]" . $e->getMessage() ."\n", 3, __DIR__ . '/../error.log');
        }finally{
            header("Location: /gestion-equipos/administration/edit-team/".$teamId);
            exit;
        }
    }

    public function deleteTeam(int $id){
        if($_SERVER["REQUEST_METHOD"] !== "POST"){
            header("Location: /gestion-equipos/administration");
        }

        try{
            $team = new Team($id);
            $team->delete();
            $_SESSION['successMessage'] = "El equipo ha sido borrado correctamente.";
        }catch(\Exception|\PDOException|\TypeError $e){
            $_SESSION['errorValidation'] = "Error al eliminar el equipo seleccionado.";
            error_log("[".date('d/m/Y H:i:s') . "]" . $e->getMessage() ."\n", 3, __DIR__ . '/../error.log');
        }finally{
            header("Location: /gestion-equipos/administration");
            exit;
        }


    }

    public function addPlayer(int $teamId){
        try{
            $team = new Team($teamId);
            include __DIR__.'/../view/administration/addPlayer.php';
            exit;
        }catch (\Exception $e){

        }
    }

    public function storePlayer(){
        try{
            $teamId = $_POST['team_id'];
            $player = new Player();
            $player->fill($_POST);
            $player->insert();
            $_SESSION['successMessage'] = "El jugador ha sido dado de alta correctamente";
            header("Location: /gestion-equipos/administration/edit-team/".$teamId);
            exit;
        }catch (\Exception $e){
            $_SESSION['errorValidation'] = $e->getMessage();
            error_log("[".date('d/m/Y H:i:s') . "]" . $e->getMessage() ."\n", 3, __DIR__ . '/../error.log');
            header("Location: /gestion-equipos/administration/edit-team/".$teamId);
            exit;
        }
    }

    public function editPlayer(int $id){
        if(isset($_SESSION['successMessage'])){
            $successMessage = $_SESSION['successMessage'];
            unset($_SESSION['successMessage']);
        }

        if(isset($_SESSION['errorValidation'])){
            $errorValidation = unserialize($_SESSION['errorValidation']);
            unset($_SESSION['errorValidation']);
        }

        try{
            $player = new Player();
            $player->getById($id);
            $team = new Team($player->getTeamId());
            include __DIR__.'/../view/administration/editPlayer.php';
        }catch (\Exception $e){
            $_SESSION['errorValidation'] = "No se ha encontrado el jugador seleccionado.";
            error_log("[".date('d/m/Y H:i:s') . "]" . $e->getMessage() ."\n", 3, __DIR__ . '/../error.log');
            header("Location: /gestion-equipos/administration");
            exit;
        }
    }

    public function updatePlayer(int $id){
        if($_SERVER["REQUEST_METHOD"] !== "POST"){
            header("Location: /gestion-equipos/administration");
        }
        try{
            $player = new Player($id);
            if(is_null($player->getId())){
                throw new \Exception("El jugador al que se intenta acceder no existe");
            }
            $player->fill($_POST);
            $player->update();
            $_SESSION['successMessage'] = "La información del jugador ha sido actualizada correctamente.";
            header("Location: /gestion-equipos/administration/edit-player/".$id);
            exit;
        }catch (\Exception $e){
            $_SESSION['errorValidation'] = $e->getMessage();
            error_log("[".date('d/m/Y H:i:s') . "]" . $e->getMessage() ."\n", 3, __DIR__ . '/../error.log');
            header("Location: /gestion-equipos/administration/edit-player/".$id);
            exit;

        }
    }
    public function deletePlayer(int $playerId){
        if($_SERVER["REQUEST_METHOD"] !== "POST"){
            header("Location: /gestion-equipos/administration/");
            exit;
        }
        try{
            $player = new Player($playerId);
            $teamId = $player->getTeamId();
            $player->delete();
            $_SESSION['successMessage'] = "El jugador ha sido eliminado correctamente";
            header("Location: /gestion-equipos/administration/edit-team/".$teamId);
            exit;
        }catch (\Exception $e){
            $_SESSION['errorValidation'] = "No se ha podido eliminar el jugador selecionado.";
            error_log("[".date('d/m/Y H:i:s') . "]" . $e->getMessage() ."\n", 3, __DIR__ . '/../error.log');
            header("Location: /gestion-equipos/administration");
            exit;
        }

    }


}
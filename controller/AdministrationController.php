<?php

namespace Controller;
use exception\TeamNameValidationException;
use Model\Team;

include "model/Team.php";
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
            $errorValidation = json_decode($_SESSION['errorValidation']);
            if(json_last_error() !== JSON_ERROR_NONE){
                $errorValidation = $_SESSION['errorValidation'];
            }
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

    public function deleteTeam(int $id){
        if($_SERVER["REQUEST_METHOD"] !== "POST"){
            header("Location: /gestion-equipos/administration");
        }

        try{
            $team = new Team();
            $team->getById($id);
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


}
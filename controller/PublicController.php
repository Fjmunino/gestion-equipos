<?php

namespace Controller;
use Model\Team;

class PublicController
{
    public function home(): void{
        include __DIR__ . "/../view/home.php";
    }

    public function futbol(): void{
        $team = new Team();
        $teams = $team->getBySport("Fútbol");
        include __DIR__ . "/../view/futbol.php";
    }

    public function baloncesto(): void{
        $team = new Team();
        $teams = $team->getBySport("Baloncesto");
        include __DIR__ . "/../view/baloncesto.php";
    }

    public function waterpolo(): void{
        $team = new Team();
        $teams = $team->getBySport("Waterpolo");
        include __DIR__ . "/../view/waterpolo.php";
    }

    public function rugby(): void{
        $team = new Team();
        $teams = $team->getBySport("Rugby");
        include __DIR__ . "/../view/rugby.php";
    }


    public function fichaEquipo(string $slug): void{
        $team = new Team();
        $team->findBySlug($slug);
        $sport = $team->getSport();
        $sport = $this->eliminarAcentos(strtolower(str_replace(' ', '-', $sport)));
        include __DIR__ . "/../view/fichaEquipo.php";
    }

    private function eliminarAcentos(string $cadena): string{
        $cadena = str_replace('á', 'a', $cadena);
        $cadena = str_replace('é', 'e', $cadena);
        $cadena = str_replace('í', 'i', $cadena);
        $cadena = str_replace('ó', 'o', $cadena);
        $cadena = str_replace('ú', 'u', $cadena);
        return $cadena;
    }
}
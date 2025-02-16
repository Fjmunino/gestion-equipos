<?php

namespace Models;

include "Team.php";
class Player
{
    private int $id;
    private int|Team $team_id;
    private string $name;
    private string $surname;
    private string $number;
    private string $birth;
    private string $captain;


    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getTeamId(): Team|int
    {
        return $this->team_id;
    }

    public function setTeamId(Team|int $team_id): void
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
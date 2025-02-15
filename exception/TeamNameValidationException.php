<?php

namespace exception;

class TeamNameValidationException extends \Exception
{
    protected $message = 'El nombre del equipo no puede estar vacío.';
}
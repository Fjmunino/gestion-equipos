<?php

namespace helper;

class Utility
{
    public static function eliminarAcentos(string $cadena): string{
        $cadena = str_replace('á', 'a', $cadena);
        $cadena = str_replace('é', 'e', $cadena);
        $cadena = str_replace('í', 'i', $cadena);
        $cadena = str_replace('ó', 'o', $cadena);
        $cadena = str_replace('ú', 'u', $cadena);
        return $cadena;
    }
}
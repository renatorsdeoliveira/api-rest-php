<?php

    namespace Source\Models;

    final class Validacao{
        public static function validacaoString(string $string){
            return strlen($string)>=3 && !is_numeric($string);
        }
        public static function validacaoEmail(string $eMail){    
            return filter_var($eMail, FILTER_VALIDATE_EMAIL);
        }
        public static function validacaoInteger(string $Integer){
            return filter_var($Integer, FILTER_VALIDATE_INT) && $Integer > 0; 
        }
    }
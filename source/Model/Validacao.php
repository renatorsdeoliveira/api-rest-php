<?php

    namespace Source\Model;

    final class Validacao{
        public function validacaoString(string $string){
            return strlen($string)>=3 && !is_numeric($string);
        }
        public function validacaoEmail(string $eMail){    
            return filter_var($eMail, FILTER_VALIDATE_EMAIL);
        }
        public function validacaoInteger(string $Integer){
            return filter_var($Integer,FILTER_VALIDATE_INT);
        }
    }
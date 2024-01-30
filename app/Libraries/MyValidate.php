<?php

namespace App\Libraries;

class MyValidate
{
    
    public function validateCpf($cpf): bool
    {
        // Extrai somente os números
        $cpf = preg_replace('/[^0-9]/is', '', $cpf);

        // Verifica se foi informado todos os digitos corretamente
        if (strlen($cpf) != 11) {
            return false;
        }

        // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }

        // Faz o calculo para validar o CPF
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }
        return true;
    }

    public function validateNis($nis): bool
    {
        // Canonicalize input
        $nis = sprintf('%011s', preg_replace('{\D}', '', $nis));

        // Validate length and invalid numbers
        if ((strlen($nis) != 11) || (intval($nis) == 0)) {
            return false;
        }

        // Validate check digit using a modulus 11 algorithm
        for ($d = 0, $p = 2, $c = 9; $c >= 0; $c--, ($p < 9) ? $p++ : $p = 2) {
            $d += $nis[$c] * $p;
        }

        return ($nis[10] == (((10 * $d) % 11) % 10));
    }

    public function valid_cns($cns): bool
    {
        helper('utils');

        $cns = tratarCns($cns);

        if($cns == '000000000000000'){
            return false;
        }

        if ((strlen(trim($cns))) != 15) {
            return false;
        }
        $pis = substr($cns, 0, 11);
        $soma = (((substr($pis, 0, 1)) * 15) +
                ((substr($pis, 1, 1)) * 14) +
                ((substr($pis, 2, 1)) * 13) +
                ((substr($pis, 3, 1)) * 12) +
                ((substr($pis, 4, 1)) * 11) +
                ((substr($pis, 5, 1)) * 10) +
                ((substr($pis, 6, 1)) * 9) +
                ((substr($pis, 7, 1)) * 8) +
                ((substr($pis, 8, 1)) * 7) +
                ((substr($pis, 9, 1)) * 6) +
                ((substr($pis, 10, 1)) * 5));
        $resto = fmod($soma, 11);
        $dv = 11 - $resto;
        if ($dv == 11) {
            $dv = 0;
        }
        if ($dv == 10) {
            $soma = ((((substr($pis, 0, 1)) * 15) +
                    ((substr($pis, 1, 1)) * 14) +
                    ((substr($pis, 2, 1)) * 13) +
                    ((substr($pis, 3, 1)) * 12) +
                    ((substr($pis, 4, 1)) * 11) +
                    ((substr($pis, 5, 1)) * 10) +
                    ((substr($pis, 6, 1)) * 9) +
                    ((substr($pis, 7, 1)) * 8) +
                    ((substr($pis, 8, 1)) * 7) +
                    ((substr($pis, 9, 1)) * 6) +
                    ((substr($pis, 10, 1)) * 5)) + 2);
            $resto = fmod($soma, 11);
            $dv = 11 - $resto;
            $resultado = $pis . "001" . $dv;
        } else {
            $resultado = $pis . "000" . $dv;
        }




        if ($cns != $resultado) {
            $soma2 = (((substr($cns, 0, 1)) * 15) +
                    ((substr($cns, 1, 1)) * 14) +
                    ((substr($cns, 2, 1)) * 13) +
                    ((substr($cns, 3, 1)) * 12) +
                    ((substr($cns, 4, 1)) * 11) +
                    ((substr($cns, 5, 1)) * 10) +
                    ((substr($cns, 6, 1)) * 9) +
                    ((substr($cns, 7, 1)) * 8) +
                    ((substr($cns, 8, 1)) * 7) +
                    ((substr($cns, 9, 1)) * 6) +
                    ((substr($cns, 10, 1)) * 5) +
                    ((substr($cns, 11, 1)) * 4) +
                    ((substr($cns, 12, 1)) * 3) +
                    ((substr($cns, 13, 1)) * 2) +
                    ((substr($cns, 14, 1)) * 1));
            $resto2 = fmod($soma2, 11);
            if ($resto2 != 0) {
                return false;
            } else {
                return true;
            }
        } else {
            return true;
        }
    }

}

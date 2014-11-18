<?php

class Validator
{

    private static $errorMessage = '';

    public function make($varName = array())
    {
        $totalVarName = count($varName);

        $listKeys = array_keys($varName);

        for ($i = 0; $i < $totalVarName; $i++) {
            $keyName = $listKeys[$i];

            if (preg_match_all('/required|min|max|email|number|alpha|word|seo|lower|upper|wordlower|wordupper/i', $varName[$keyName])) {

                $listRequire = explode('|', $varName[$keyName]);

                $totalRequire = count($listRequire);

                for ($j = 0; $j < $totalRequire; $j++) {
                    $reqValue = trim($listRequire[$j]);

                    if (preg_match('/(\w+)\:(\d+)/i', $reqValue, $matchesReqValues)) {

                        $matchLeft = $matchesReqValues[1];

                        $matchRight = (int)$matchesReqValues[2];

                        $keyValue = $_REQUEST[$keyName];

                        switch ($matchLeft) {
                            case 'min':
                                $matchRight--;

                                if (!isset($keyValue[$matchRight])) return false;

                                break;
                            case 'max':
                                $matchRight;

                                if (isset($keyValue[$matchRight])) return false;

                                break;


                        }

                    } else {

                        switch ($reqValue) {
                            case 'required':
                                if (!isset($_REQUEST[$keyName])) return false;
                                break;
                            case 'email':

                                if (!preg_match('/^.*?\@.*?\.\w+$/i', $_REQUEST[$keyName])) return false;
                                break;
                            case 'number':
                                if (!preg_match('/^\d+$/', $_REQUEST[$keyName])) return false;
                                break;
                            case 'alpha':
                                if (!preg_match('/^[a-zA-Z]+$/i', $_REQUEST[$keyName])) return false;
                                break;
                            case 'word':
                                if (!preg_match('/^[a-zA-Z0-9_\@\!\#\$\%\^\&\*\(\)\.\|]+$/i', $_REQUEST[$keyName])) return false;
                                break;
                            case 'seo':
                                if (!preg_match('/^[a-zA-Z0-9_\.\_\:\-\_\=\|]+$/i', $_REQUEST[$keyName])) return false;
                                break;
                            case 'lower':
                                if (!preg_match('/^[a-z]+$/', $_REQUEST[$keyName])) return false;
                                break;
                            case 'upper':
                                if (!preg_match('/^[A-Z]+$/', $_REQUEST[$keyName])) return false;
                                break;


                        }
                    }


                }


            } else {
                if ($_REQUEST[$keyName] != $varName[$keyName]) {

                    return false;
                }
            }

        }

        return true;

    }
    public function check($varName = array())
    {
        $totalVarName = count($varName);

        $listKeys = array_keys($varName);

        for ($i = 0; $i < $totalVarName; $i++) {
            $keyName = $listKeys[$i];

            if (preg_match_all('/min|max|email|number|alpha|word|seo|lower|upper|wordlower|wordupper/i', $varName[$keyName])) {

                $listRequire = explode('|', $varName[$keyName]);

                $totalRequire = count($listRequire);

                for ($j = 0; $j < $totalRequire; $j++) {
                    $reqValue = trim($listRequire[$j]);

                    if (preg_match('/(\w+)\:(\d+)/i', $reqValue, $matchesReqValues)) {

                        $matchLeft = $matchesReqValues[1];

                        $matchRight = (int)$matchesReqValues[2];

                        $keyValue = $keyName;

                        switch ($matchLeft) {
                            case 'min':
                                $matchRight--;

                                if (!isset($keyValue[$matchRight])) return false;

                                break;
                            case 'max':
                                $matchRight;

                                if (isset($keyValue[$matchRight])) return false;

                                break;


                        }

                    } else {

                        switch ($reqValue) {
                            case 'email':
                                if (!preg_match('/^.*?\@.*?\.\w+$/i', $keyName)) return false;
                                break;
                            case 'number':
                                if (!preg_match('/^\d+$/', $keyName)) return false;
                                break;
                            case 'alpha':
                                if (!preg_match('/^[a-zA-Z]+$/i', $keyName)) return false;
                                break;
                            case 'word':
                                if (!preg_match('/^[a-zA-Z0-9_\@\!\#\$\%\^\&\*\(\)\.\|]+$/i', $keyName)) return false;
                                break;
                            case 'seo':
                                if (!preg_match('/^[a-zA-Z0-9_\.\_\:\-\_\=\|]+$/i', $keyName)) return false;
                                break;
                            case 'lower':
                                if (!preg_match('/^[a-z]+$/', $keyName)) return false;
                                break;
                            case 'upper':
                                if (!preg_match('/^[A-Z]+$/', $keyName)) return false;
                                break;


                        }
                    }


                }


            } 

        }

        return true;

    }


}


?>
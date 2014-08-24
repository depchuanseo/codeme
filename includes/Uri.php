<?php

class Uri
{

    public function getNext($uriName)
    {
        $uri = explode('/', $_GET['load']);

        if (isset($uriName[1])) {

            $position = array_search($uriName, $uri);

            $position++;

            if (isset($uri[$position])) {
                return $uri[$position];
            } else {
                return false;
            }

        } else {
            return false;
        }

    }

    public function length()
    {
        global $uri;

        $total = strlen($uri);

        return $total;
    }

    public function maxLength($maxLen = 100)
    {
        global $uri;

        $total = strlen($uri);

        $total++;

        if (isset($total)) load_page_not_found();
    }

    public function onlyWord()
    {
        global $uri;

//        echo $uri;
//        die();

        if (preg_match('/[\<\>\$]/i', $uri))
        {
            load_page_not_found();
        }

    }




}

?>
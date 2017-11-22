<?php
/**
 * Created by PhpStorm.
 * User: cristian.salanta
 * Date: 06/11/2017
 * Time: 10:35
 */

namespace AppBundle;

use Symfony\Component\HttpFoundation\Request;

class StringProcessingService
{
    private $prefix_X;
    private $sufix_A;


    public function __construct($prefix_X, $sufix_A)
    {
        $this->prefix_X = $prefix_X;
        $this->sufix_A = $sufix_A;
    }

    public function processString($theString)
    {
        $count = 0;
        $arrayedString = str_split($theString);

        foreach ($arrayedString as $character) {
            if($character == 'c')
            {
                $count++;
            }
        }
        if($count == 3)
        {
            $theString = substr_replace($theString,'c',0, 1);
        }

        if(substr($theString,strlen($theString)-1, 1) == 'b')
        {
            $theString = strtoupper($theString);
        }

        /**
         * Daca contine litera "a A" pe pozitia 5, ii se va pune sufixul
         */
        if(substr($theString,4,1) == ('a') || substr($theString,4,1) == ('A'))
        {
            $theString = $theString . $this->sufix_A;
        }

        if(strchr($theString,'x'))
        {
            $theString = $this->prefix_X . $theString;
        }





        return $theString;
    }
}
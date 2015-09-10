<?php
/**
 * Created by PhpStorm.
 * User: leroy
 * Date: 10/09/15
 * Time: 10:43
 */

namespace AppBundle\Service;


class HelloWorldService
{

    protected $word;


    public function write($word=null){
        if(!is_null($word)){
            $this->word = $word;
        }
        return $this->word;
    }
}
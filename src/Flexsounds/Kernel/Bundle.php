<?php
/**
 * Created by PhpStorm.
 * User: leroy
 * Date: 1/18/16
 * Time: 8:55 PM
 */

namespace Flexsounds\Kernel;


abstract class Bundle
{

    protected $name;
    protected $path;

    public function getNamespace()
    {
        $class = get_class($this);
        return substr($class, 0, strrpos($class, '\\'));
    }

    final public function getName()
    {
        if(null === $this->name){
            $name = get_class($this);
            $pos = strrpos($name, '\\');
            $this->name = false == $pos ? $name : substr($name, $pos + 1);
        }
        return $this->name;
    }

    public function boot()
    {

    }

    public function getPath($subPath=null)
    {
        if(null == $this->path){
            $r = new \ReflectionObject($this);
            $this->path = dirname($r->getFileName());
        }
        if(null !== $subPath){
            return realpath(rtrim($this->path). "/" .ltrim($subPath));
        }
        return $this->path;
    }

    public function getResourcePath()
    {
        return $this->getPath("/Resource");
    }

}

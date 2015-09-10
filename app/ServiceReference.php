<?php


class ServiceReference
{

    protected $name;

    protected $className;

    protected $parameters;

    protected $tags;

    /**
     * ServiceReference constructor.
     *
     * @param array $config
     */
    public function __construct(array $config=null)
    {
        if(!is_null($config)) {
            $config = $this->createConfig($config);
            $this->setName($config['name']);
            $this->setParameters($config['arguments']);
            $this->setClassName($config['class']);
            $this->setTags($config['tags']);
        }
    }


    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getClassName()
    {
        return $this->className;
    }

    /**
     * @param mixed $className
     * @return $this
     */
    public function setClassName($className)
    {
        $this->className = $className;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * @param mixed $parameters
     * @return $this
     */
    public function setParameters($parameters)
    {
        $this->parameters = $parameters;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @param mixed $tags
     * @return $this
     */
    public function setTags($tags)
    {
        $this->tags = $tags;
        return $this;
    }


    public function createConfig(array $config)
    {
        $return = array(
            'name' => null,
            'class' => null,
            'arguments' => null,
            'tags' => null
        );
        if(array_key_exists('name', $config)){
            $return['name'] = $config['name'];
        }
        if(array_key_exists('class', $config)){
            $return['class'] = $config['class'];
        }
        if(array_key_exists('arguments', $config)){
            $return['arguments'] = $config['arguments'];
        }
        if(array_key_exists('tags', $config)){
            $return['tags'] = $config['tags'];
        }

        return $return;
    }

    /**
     * @return object
     * @throws Exception
     */
    public function getService()
    {
        if(!$this->getClassName()){
            throw new \Exception("Cannot create a service when no class is given");
        }

        if(!class_exists($this->getClassName())){
            throw new \Exception(sprintf("Class %s does not exists, cannot create service", $this->getClassName()));
        }

        $reflectionClass = new ReflectionClass($this->getClassName());

        if($reflectionClass->getConstructor()){
            $instance = $this->createServiceInstanceWithArguments($reflectionClass, $this->getParameters());
        }else{
            $instance = $reflectionClass->newInstanceWithoutConstructor();
        }

        return $instance;
    }


    /**
     * @param ReflectionClass $reflectionClass
     * @param array           $arguments
     * @return object
     */
    protected function createServiceInstanceWithArguments(ReflectionClass $reflectionClass, array $arguments)
    {
        return $reflectionClass->newInstanceArgs($arguments);
    }



}
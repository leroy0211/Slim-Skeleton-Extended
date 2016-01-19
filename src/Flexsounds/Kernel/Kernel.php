<?php
namespace Flexsounds\Kernel;


abstract class Kernel
{
    use ContainerAwareTrait;

    protected $bundles = array();
    protected $environment;
    protected $debug;
    protected $startTime;
    protected $booted = false;
    protected $rootDir;

    function __construct($environment, $debug)
    {
        $this->environment = $environment;
        $this->debug = (bool) $debug;
        $this->rootDir = $this->getRootDir();

        if($this->debug){
            $this->startTime = microtime(true);
        }
    }

    /**
     * @return Bundle[]
     */
    abstract public function registerBundles();

    /**
     * @return Bundle[]
     */
    public function getBundles()
    {
        return $this->bundles;
    }

    /**
     * Boot the Kernel
     *
     * @throws \Exception
     */
    public function boot()
    {
        if(true === $this->booted){
            return;
        }

        $this->initPreBoot();

        $this->initializeBundles();

        foreach ($this->getBundles() as $bundle) {
            $bundle->boot();
        }

        $this->initPostBoot();

        $this->booted = true;
    }

    /**
     * Init custom pre-boot options
     */
    protected function initPreBoot(){}

    /**
     * Init custom post-boot options
     */
    protected function initPostBoot(){}

    /**
     * Initialize the registered bundles
     *
     * @throws \Exception
     */
    protected function initializeBundles()
    {
        $this->bundles = array();

        foreach ($this->registerBundles() as $bundle) {
            $name = $bundle->getName();

            if(isset($this->bundles[$name])){
                throw new \Exception(sprintf('Trying to register two bundles with the same name "%s"', $name));
            }

            $this->bundles[$name] = $bundle;
        }
    }


    protected function getKernelParameters()
    {
        $bundles = array();
        foreach ($this->getBundles() as $name => $bundle) {
            $bundles[$name] = get_class($bundle);
        }

        return array(
            'kernel.root_dir' => $this->getRootDir(),
            'kernel.environment' => $this->getEnvironment(),
            'kernel.debug' => $this->isDebug(),
            'kernel.cache_dir' => $this->getCachePath(),
            'kernel.logs_dir' => $this->getLogPath(),
            'kernel.bundles' => $bundles
        );
    }

    protected function getRootDir()
    {
        if(null == $this->rootDir){
            $r = new \ReflectionObject($this);
            $this->rootDir = dirname($r->getFileName());
        }
        return $this->rootDir;
    }

    /**
     * @return mixed
     */
    public function getEnvironment()
    {
        return $this->environment;
    }

    /**
     * @return boolean
     */
    public function isDebug()
    {
        return $this->debug;
    }

    protected function getPath($subPath=null)
    {
        return realpath(rtrim($this->getRootDir()). DIRECTORY_SEPARATOR .ltrim($subPath));
    }

    public function getCachePath()
    {
        return $this->getPath('/cache/'.$this->getEnvironment());
    }

    public function getLogPath()
    {
        return $this->getPath('/logs');
    }

    public function getConfigPath()
    {
        return $this->getPath('/config');
    }

}

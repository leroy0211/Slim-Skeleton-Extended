<?php


class AppKernel extends \Flexsounds\Kernel\Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            new \AppBundle\AppBundle()
        );

        if(in_array($this->environment, array("dev", "test"))){
//            $bundles[] = new Bundle();
        }
        return $bundles;
    }

    protected function initializeContainer()
    {
        parent::initializeContainer();

        $container = new \Flexsounds\Component\SymfonyContainerSlimBridge\ContainerBuilder();
        $loader = new \Symfony\Component\DependencyInjection\Loader\YamlFileLoader($container, new \Symfony\Component\Config\FileLocator(__DIR__));
        $loader->load($this->getConfigPath(). "/config_".$this->getEnvironment().".yml");
        $this->setContainer($container);
    }


}

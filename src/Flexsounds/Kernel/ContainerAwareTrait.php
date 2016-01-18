<?php

namespace Flexsounds\Kernel;

use Interop\Container\ContainerInterface;

trait ContainerAwareTrait
{

    /** @var ContainerInterface */
    protected $container;

    /**
     * @param ContainerInterface $container
     */
    public function setContainer(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @return ContainerInterface
     */
    public function getContainer()
    {
        return $this->container;
    }

}

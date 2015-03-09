<?php

namespace Vinkla\Instagram;

use GrahamCampbell\Manager\AbstractManager;
use Illuminate\Contracts\Config\Repository;
use Vinkla\Instagram\Factories\InstagramFactory;

class InstagramManager extends AbstractManager
{
    /**
     * @var InstagramFactory
     */
    private $factory;

    /**
     * @param Repository $config
     * @param InstagramFactory $factory
     */
    public function __construct(Repository $config, InstagramFactory $factory)
    {
        parent::__construct($config);

        $this->factory = $factory;
    }

    /**
     * Create the connection instance.
     *
     * @param array $config
     *
     * @return mixed
     */
    protected function createConnection(array $config)
    {
        return $this->factory->make($config);
    }

    /**
     * Get the configuration name.
     *
     * @return string
     */
    protected function getConfigName()
    {
        return 'instagram';
    }

    /**
     * Get the factory instance.
     *
     * @return InstagramFactory
     */
    public function getFactory()
    {
        return $this->factory;
    }
}

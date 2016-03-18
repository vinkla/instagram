<?php

/*
 * This file is part of Laravel Instagram.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Vinkla\Instagram\Session;

use Illuminate\Session\Store;
use Larabros\Elogram\Http\Sessions\DataStoreInterface;

/**
 * This is the session store class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class SessionStore implements DataStoreInterface
{
    /**
     * The session instance.
     *
     * @var \Illuminate\Session\Store
     */
    protected $session;

    /**
     * Create a new session store instance.
     *
     * @param \Illuminate\Session\Store $session
     */
    public function __construct(Store $session)
    {
        $this->session = $session;
    }

    /**
     * Get a value from a persistent data store.
     *
     * @param string $key
     *
     * @return mixed
     */
    public function get($key)
    {
        return $this->session->get($key);
    }

    /**
     * Set a value in the persistent data store.
     *
     * @param string $key
     * @param mixed $value
     */
    public function set($key, $value)
    {
        $this->session->set($key, $value);
    }
}

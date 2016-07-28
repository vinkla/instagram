<?php
/*
 * This file is part of Laravel Instagram.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * added by Nicolas Traeder <github.com/traedamatic>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Vinkla\Instagram\Providers;

use Illuminate\Support\Facades\App;
use Larabros\Elogram\Http\Sessions\DataStoreInterface;
use League\Container\ServiceProvider\AbstractServiceProvider;
use Vinkla\Instagram\Session\SessionStore;

class SessionStoreProvider extends AbstractServiceProvider
{
    protected $provides = [
        DataStoreInterface::class
    ];

    /**
     * Use the register method to register items with the container via the
     * protected $this->container property or the `getContainer` method
     * from the ContainerAwareTrait.
     *
     * @return void
     */
    public function register()
    {
        $this->getContainer()->share(DataStoreInterface::class, new SessionStore(App::make('Illuminate\Session\Store')));
    }
}

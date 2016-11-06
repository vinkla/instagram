<?php

/*
 * This file is part of Instagram.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Vinkla\Instagram\Exceptions;

use Exception;

/**
 * This is the not found exception class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class NotFoundException extends Exception implements InstagramExceptionInterface
{
    //
}

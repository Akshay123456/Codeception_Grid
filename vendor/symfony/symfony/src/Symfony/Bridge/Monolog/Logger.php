<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Bridge\Monolog;

use Monolog\Logger as BaseLogger;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Log\DebugLoggerInterface;

/**
 * Logger.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
class Logger extends BaseLogger implements DebugLoggerInterface
{
    /**
     * {@inheritdoc}
     */
    public function getLogs(/* Request $request = null */)
    {
        if ($logger = $this->getDebugLogger()) {
            return \call_user_func_array([$logger, 'getLogs'], \func_get_args());
        }

        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function countErrors(/* Request $request = null */)
    {
        if ($logger = $this->getDebugLogger()) {
            return \call_user_func_array([$logger, 'countErrors'], \func_get_args());
        }

        return 0;
    }

    /**
     * {@inheritdoc}
     */
    public function clear()
    {
        if ($logger = $this->getDebugLogger()) {
            $logger->clear();
        }
    }

    /**
     * Returns a DebugLoggerInterface instance if one is registered with this logger.
     *
     * @return DebugLoggerInterface|null A DebugLoggerInterface instance or null if none is registered
     */
    private function getDebugLogger()
    {
        foreach ($this->processors as $processor) {
            if ($processor instanceof DebugLoggerInterface) {
                return $processor;
            }
        }

        foreach ($this->handlers as $handler) {
            if ($handler instanceof DebugLoggerInterface) {
                return $handler;
            }
        }
    }
}

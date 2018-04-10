<?php
namespace Yeebase\Readiness\Test;

/**
 * This file is part of the Yeebase.XY package.
 *
 * (c) 2018 yeebase media GmbH
 *
 * This package is Open Source Software. For the full copyright and license
 * information, please view the LICENSE file which was distributed with this
 * source code.
 */

use Neos\Flow\Configuration\Exception\InvalidConfigurationException;

class RedisTest extends AbstractTest
{
    /**
     * @param array $options
     * @throws InvalidConfigurationException
     */
    protected function validateOptions(array $options)
    {
        if (!isset($options['hostname'])) {
            throw new InvalidConfigurationException('Redis readiness test needs a "hostname" option', 1502701659);
        }
    }

    /**
     * @return bool
     */
    public function test(): bool
    {
        $redis = new \Redis();
        $result = $redis->connect($this->options['hostname']);

        if ($result) {
            $redis->close();
        }

        return $result;
    }
}

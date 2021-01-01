<?php

/*
 * (c) Tamer Agaoglu  <farerock@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Tamert\Spiralizer\Annotation;

use Tamert\Spiralizer\Excepiton\InvalidArgumentException;

/**
 * Annotation class for @Groups().
 *
 * @Annotation
 * @Target({"PROPERTY", "METHOD"})
 */
class Groups
{
    /**
     * @var string[]
     */
    private $groups;

    /**
     * @throws InvalidArgumentException
     */
    public function __construct(array $data)
    {
        if (!isset($data['value']) || !$data['value']) {
            throw new InvalidArgumentException(sprintf('Parameter of annotation "%s" cannot be empty.', static::class));
        }

        $value = (array)$data['value'];
        foreach ($value as $group) {
            if (!\is_string($group)) {
                throw new InvalidArgumentException(sprintf('Parameter of annotation "%s" must be a string or an array of strings.', static::class));
            }
        }

        $this->groups = $value;
    }

    /**
     * Gets groups.
     *
     * @return string[]
     */
    public function getGroups()
    {
        return $this->groups;
    }
}

<?php

/*
 * (c) Tamer Agaoglu  <farerock@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Tamert\Spiralizer\Serializer;

class Serializer implements SerializerInterface
{
    /**
     * @var false
     */
    private $many;

    /**
     * @var array
     */
    private $groups = [];

    private $data = [];

    /**
     * Serializer constructor.
     * @param false $many
     */
    public function __construct($many = false)
    {
        $this->many = $many;
    }

    /**
     * @return array
     */
    public function boot()
    {
        return [];
    }

    public function __invoke()
    {
        $this->groups = $this->boot();

        return $this->groups;
    }

    public function create($validatedData)
    {
        return $validatedData;
    }

    public function update($validatedData)
    {
        return $validatedData;
    }

    public function get($data)
    {
        return $data;
    }

}

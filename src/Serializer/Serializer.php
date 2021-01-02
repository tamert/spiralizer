<?php

/*
 * (c) Tamer Agaoglu  <farerock@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Tamert\Spiralizer\Serializer;

use Cycle\ORM\ORMInterface;
use Cycle\Schema\Definition\Entity;
use Tamert\Spiralizer\Excepiton\InvalidArgumentException;
use Spiral\Debug;
use ReflectionClass;

class Serializer implements SerializerInterface
{
    /**
     * @var false
     */
    private $many = false;

    /**
     * @var array
     */
    private $groups = [];

    private $data = [];

    /** @var ORMInterface */
    private $orm;

    /**
     * @param ORMInterface $orm
     */
    public function __construct(ORMInterface $orm)
    {
        $this->orm = $orm;
    }

    /**
     * @return array
     */
    public function boot()
    {
        return [];
    }

    /**
     * @param $data
     * @param false $mant
     * @return array
     */
    public function serialize($data, $many = false)
    {
        $this->many = $many;
        $this->groups = $this->boot();
        if ($this->many) {
            // if (!$data instanceof Entity) {
            //     throw new InvalidArgumentException("Data is not a Entity");
            // }

        } else {
            if (!is_object($data)) {
                throw new InvalidArgumentException("Data is not a object");
            }
            $objectFqCn = get_class($data);
            

            $debugger = new Debug\Dumper();
            $debugger->dump($objectFqCn);


        }
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

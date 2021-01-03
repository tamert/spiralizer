<?php

/*
 * (c) Tamer Agaoglu  <farerock@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Tamert\Spiralizer\Serializer;

use Tamert\Spiralizer\Annotation\Groups;
use Tamert\Spiralizer\Exception\InvalidArgumentException;
use Doctrine\Common\Annotations\AnnotationException;
use Doctrine\Common\Annotations\AnnotationReader;

use Spiral\Debug;

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

    /**
     * @var AnnotationReader
     */
    private $reader;

    /**
     * Serializer constructor.
     */
    public function __construct()
    {
        $this->reader = new AnnotationReader();
    }

    /**
     * @return array
     */
    public function boot()
    {
        return [];
    }

    /**
     * @param $class
     * @return array|void
     */
    public function item($class)
    {
        if ($class === null) {
            return;
        }

        try {
            $class = new \ReflectionClass($class);
        } catch (\ReflectionException $e) {
            return;
        }

        $properties = [];

        foreach ($class->getProperties() as $property) {

            try {
                $tann = $this->reader->getPropertyAnnotation($property, Groups::class);
                $properties[$property->getName()] = $tann;
            } catch (AnnotationException $e) {
                $properties[$property->getName()] = $property->getDocComment();
            }
        }

        $debugger = new Debug\Dumper();
        $debugger->dump($properties);

        return $properties;
    }

    /**
     * @param $data
     * @param false $many
     * @return array|void
     */
    public function serialize($data, $many = false)
    {
        $this->many = $many;
        $this->groups = $this->boot();
        if ($this->many) {
            if (!is_array($data)) {
                throw new InvalidArgumentException("data is not array");
            }
            return array_map(function ($item) {
                return $this->item($item);
            }, $data);
        } else {
            return $this->item($data);
        }
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

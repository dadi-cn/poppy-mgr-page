<?php
declare(strict_types = 1);

namespace Poppy\CanalEs\Classes\Es;

class Index
{
    /**
     * @var array
     */
    private $properties;

    /**
     * @var string
     */
    private $index;

    /**
     * Index constructor.
     * @param string $index
     * @param string $propertyFile
     */
    public function __construct(string $index, string $propertyFile = '')
    {
        $this->index      = $index;
        $this->properties = $this->loadPropertyFile($propertyFile);
    }

    /**
     * @return array|callable
     */
    public function create()
    {
        $client = Client::instance();
        $params = [
            'index' => $this->index,
            'body'  => $this->properties,
        ];

        return $client->indices()->create($params);
    }

    protected function loadPropertyFile(string $propertyFile): array
    {
        if (!class_exists($propertyFile)) {
            return [];
        }

        return (new $propertyFile)();
    }
}
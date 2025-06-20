<?php
namespace Foundational\Router;

class Route
{
    public string $method;
    public string $path;
    public $handler;
    private ?string $name = null;

    public function __construct(string $method, string $path, callable|string $handler)
    {
        $this->method = strtoupper($method);
        $this->path = $path;
        $this->handler = $handler;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }
}

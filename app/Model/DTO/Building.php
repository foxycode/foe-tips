<?php declare(strict_types=1);

namespace App\Model\DTO;

final class Building
{
    public string $name;
    public string $image;
    public BuildingType $type;
    public BuildingSize $size;
    public array $properties = [];

    public function __construct(string $name, string $image, BuildingType $type, BuildingSize $size)
    {
        $this->name = $name;
        $this->image = $image;
        $this->type = $type;
        $this->size = $size;
    }

    public static function fromMatcher(array $matches): self
    {
        $building = new self(
            $matches['name'],
            $matches['image'],
            new BuildingType($matches['type']),
            BuildingSize::fromString($matches['size'])
        );

        $properties = [];
        foreach ($matches['propertyHeader'] as $position => $imageName) {
            $properties[$position] = Property::fromImageName($imageName);
        }

        foreach ($matches['ages'] as $age) {
            $ageName = array_shift($age);
            foreach ($age as $position => $value) {
                $building->addProperty(new Age($ageName), $properties[$position], $value);
            }
        }

        return $building;
    }

    public function addProperty(Age $age, Property $property, string $value): void
    {
        if (!array_key_exists($age->name, $this->properties)) {
            $this->properties[$age->name] = [];
        }

        $this->properties[$age->name][$property->name] = new BuildingProperty(
            $this,
            $property,
            $age,
            PropertyValue::fromString($value)
        );
    }

    public function getProperty(string $age, string $property): BuildingProperty
    {
        return $this->properties[$age][$property];
    }
}

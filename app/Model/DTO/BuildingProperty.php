<?php declare(strict_types=1);

namespace App\Model\DTO;

final class BuildingProperty
{
    public Building $building;
    public Property $property;
    public Age $age;
    public PropertyValue $value;

    public function __construct(Building $building, Property $property, Age $age, PropertyValue $value)
    {
        $this->building = $building;
        $this->property = $property;
        $this->age = $age;
        $this->value = $value;
    }
}

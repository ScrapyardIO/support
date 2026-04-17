<?php

if(!function_exists('reflect_property'))
{
    function reflect_property(object $object, string $attribute) : ?ReflectionProperty
    {
        $reflection = new ReflectionClass($object);
        foreach($reflection->getProperties() as $property)
        {
            $result = $property->getAttributes($attribute);
            if($result) return $property;
        }

        return null;
    }
}
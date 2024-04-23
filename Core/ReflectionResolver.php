<?php

declare(strict_types=1);

namespace Test\Check24\Core;

class ReflectionResolver
{
    /**
     * @throws \ReflectionException
     */
    public function resolve(string $class): object
    {
        try {
            $reflectionClass = new \ReflectionClass($class);

            if (!$reflectionClass->getConstructor()) {
                return $reflectionClass->newInstance();
            }

            $constructorParams = $reflectionClass->getConstructor()->getParameters();

            if (empty($constructorParams)) {
                return $reflectionClass->newInstance();
            }

            $newInstanceParams = [];
            foreach ($constructorParams as $param) {
                $paramType = $param->getType();
                $newInstanceParams[] = !$paramType ? $param->getDefaultValue() : $this->resolve(
                    $paramType->getName()
                );
            }

            return $reflectionClass->newInstanceArgs(
                $newInstanceParams
            );
        } catch (\ReflectionException $e) {
            throw new \ReflectionException($e->getMessage());
        }
    }
}

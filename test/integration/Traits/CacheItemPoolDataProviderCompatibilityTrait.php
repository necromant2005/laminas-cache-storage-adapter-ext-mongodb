<?php

declare(strict_types=1);

namespace LaminasTest\Cache\Storage\Adapter\Traits;

use PHPUnit\Framework\Attributes\DataProvider;

/**
 * Adds PHPUnit attribute based data providers so the inherited
 * integration tests keep working under PHPUnit 11+ where docblock
 * annotations are ignored.
 */
trait CacheItemPoolDataProviderCompatibilityTrait
{
    #[DataProvider('invalidKeys')]
    public function testGetItemInvalidKeys($key): void
    {
        parent::testGetItemInvalidKeys($key);
    }

    #[DataProvider('invalidKeys')]
    public function testGetItemsInvalidKeys($key): void
    {
        parent::testGetItemsInvalidKeys($key);
    }

    #[DataProvider('invalidKeys')]
    public function testHasItemInvalidKeys($key): void
    {
        parent::testHasItemInvalidKeys($key);
    }

    #[DataProvider('invalidKeys')]
    public function testDeleteItemInvalidKeys($key): void
    {
        parent::testDeleteItemInvalidKeys($key);
    }

    #[DataProvider('invalidKeys')]
    public function testDeleteItemsInvalidKeys($key): void
    {
        parent::testDeleteItemsInvalidKeys($key);
    }
}

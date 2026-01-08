<?php

declare(strict_types=1);

namespace LaminasTest\Cache\Storage\Adapter\Traits;

use PHPUnit\Framework\Attributes\DataProvider;

/**
 * Mirrors the upstream data provider annotations using attributes so the
 * inherited tests continue to run on PHPUnit versions that dropped
 * docblock support.
 */
trait SimpleCacheDataProviderCompatibilityTrait
{
    #[DataProvider('invalidKeys')]
    public function testGetInvalidKeys($key): void
    {
        parent::testGetInvalidKeys($key);
    }

    #[DataProvider('invalidKeys')]
    public function testGetMultipleInvalidKeys($key): void
    {
        parent::testGetMultipleInvalidKeys($key);
    }

    #[DataProvider('invalidKeys')]
    public function testSetInvalidKeys($key): void
    {
        parent::testSetInvalidKeys($key);
    }

    #[DataProvider('invalidArrayKeys')]
    public function testSetMultipleInvalidKeys($key): void
    {
        parent::testSetMultipleInvalidKeys($key);
    }

    #[DataProvider('invalidKeys')]
    public function testHasInvalidKeys($key): void
    {
        parent::testHasInvalidKeys($key);
    }

    #[DataProvider('invalidKeys')]
    public function testDeleteInvalidKeys($key): void
    {
        parent::testDeleteInvalidKeys($key);
    }

    #[DataProvider('invalidKeys')]
    public function testDeleteMultipleInvalidKeys($key): void
    {
        parent::testDeleteMultipleInvalidKeys($key);
    }

    #[DataProvider('validKeys')]
    public function testSetValidKeys(string $key): void
    {
        parent::testSetValidKeys($key);
    }

    #[DataProvider('validKeys')]
    public function testSetMultipleValidKeys(string $key): void
    {
        parent::testSetMultipleValidKeys($key);
    }

    #[DataProvider('validData')]
    public function testSetValidData($data): void
    {
        parent::testSetValidData($data);
    }

    #[DataProvider('validData')]
    public function testSetMultipleValidData($data): void
    {
        parent::testSetMultipleValidData($data);
    }
}

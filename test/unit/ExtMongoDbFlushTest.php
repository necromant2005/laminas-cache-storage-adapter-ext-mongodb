<?php

declare(strict_types=1);

namespace LaminasTest\Cache\Storage\Adapter;

use ArrayObject;
use Laminas\Cache\Exception\RuntimeException;
use Laminas\Cache\Storage\Adapter\ExtMongoDb;
use Laminas\Cache\Storage\Adapter\ExtMongoDbOptions;
use Laminas\Cache\Storage\Adapter\ExtMongoDbResourceManager;
use MongoDB\Collection;
use MongoDB\Driver\Exception\Exception as MongoDriverException;
use PHPUnit\Framework\TestCase;

final class ExtMongoDbFlushTest extends TestCase
{
    public function testFlushReturnsTrueWhenDropCompletesWithoutResult(): void
    {
        $collection = $this->createMock(Collection::class);
        $collection
            ->expects(self::once())
            ->method('drop')
            ->willReturnCallback(static function (): void {
            });

        $storage = $this->createStorageUsingCollection($collection);

        self::assertTrue($storage->flush());
    }

    public function testFlushWrapsDriverExceptionsIntoCacheRuntimeExceptions(): void
    {
        $collection = $this->createMock(Collection::class);
        $collection
            ->expects(self::once())
            ->method('drop')
            ->willThrowException($this->createDriverException());

        $storage = $this->createStorageUsingCollection($collection);

        $this->expectException(RuntimeException::class);
        $storage->flush();
    }

    public function testLegacyDropArrayResultIsHandled(): void
    {
        self::assertTrue($this->invokeDropOperationSucceeded(['ok' => 1.0]));
    }

    public function testLegacyDropArrayWithoutOkFieldSucceeds(): void
    {
        self::assertTrue($this->invokeDropOperationSucceeded(['dropped' => true]));
    }

    public function testLegacyDropArrayWithFailedOkReturnsFalse(): void
    {
        self::assertFalse($this->invokeDropOperationSucceeded(['ok' => 0]));
    }

    public function testLegacyDropArrayObjectResultIsHandled(): void
    {
        self::assertTrue($this->invokeDropOperationSucceeded(new ArrayObject(['ok' => 1.0])));
    }

    public function testLegacyDropStdClassResultIsHandled(): void
    {
        self::assertTrue($this->invokeDropOperationSucceeded((object) ['ok' => 1.0]));
    }

    private function createStorageUsingCollection(Collection $collection): ExtMongoDb
    {
        $resourceManager = new ExtMongoDbResourceManager();
        $resourceManager->setResource('test-resource', $collection);

        $options = new ExtMongoDbOptions();
        $options->setResourceManager($resourceManager);
        $options->setResourceId('test-resource');

        $storage = new ExtMongoDb();
        $storage->setOptions($options);

        return $storage;
    }

    private function createDriverException(): MongoDriverException
    {
        return new class ('drop failed') extends \RuntimeException implements MongoDriverException {
        };
    }

    private function invokeDropOperationSucceeded(mixed $result): bool
    {
        $reflection = new \ReflectionMethod(ExtMongoDb::class, 'dropOperationSucceeded');
        $reflection->setAccessible(true);

        return $reflection->invoke(null, $result);
    }
}

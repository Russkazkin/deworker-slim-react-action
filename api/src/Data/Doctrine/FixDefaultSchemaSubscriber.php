<?php

declare(strict_types=1);

namespace App\Data\Doctrine;

use Doctrine\Common\EventSubscriber;
use Doctrine\DBAL\Exception;
use Doctrine\DBAL\Schema\PostgreSQLSchemaManager;
use Doctrine\DBAL\Schema\SchemaException;
use Doctrine\ORM\Tools\Event\GenerateSchemaEventArgs;
use Doctrine\ORM\Tools\ToolEvents;

class FixDefaultSchemaSubscriber implements EventSubscriber
{
    public function getSubscribedEvents(): array
    {
        return [
            ToolEvents::postGenerateSchema => 'postGenerateSchema'
        ];
    }

    /**
     * @throws Exception
     * @throws SchemaException
     * @psalm-suppress RedundantCondition
     * @psalm-suppress InternalMethod
     */
    public function postGenerateSchema(GenerateSchemaEventArgs $args): void
    {
        $schemaManager = $args
            ->getEntityManager()
            ->getConnection()
            ->createSchemaManager();

        if (!$schemaManager instanceof PostgreSqlSchemaManager) {
            return;
        }
        foreach ($schemaManager->getExistingSchemaSearchPaths() as $namespace) {
            if (!$args->getSchema()->hasNamespace($namespace)) {
                $args->getSchema()->createNamespace($namespace);
            }
        }
    }
}

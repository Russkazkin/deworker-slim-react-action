<?php

declare(strict_types=1);

namespace App\Auth\Query\FindIdentityById;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Exception;

final class Fetcher
{
    public function __construct(private readonly Connection $connection) {}

    /**
     * @throws Exception
     */
    public function fetch(string $id): ?Identity
    {
        $stmt = $this->connection->createQueryBuilder()
            ->select(['id', 'role'])
            ->from('auth_users')
            ->where('id = :id')
            ->setParameter('id', $id)
            ->executeQuery();

        /** @var array{id: string, role: string}|false $row */
        $row = $stmt->fetchAssociative();

        if ($row === false) {
            return null;
        }

        return new Identity(
            id: $row['id'],
            role: $row['role']
        );
    }
}

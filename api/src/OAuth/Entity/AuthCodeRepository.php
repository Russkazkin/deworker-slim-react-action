<?php

declare(strict_types=1);

namespace App\OAuth\Entity;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use League\OAuth2\Server\Entities\AuthCodeEntityInterface;
use League\OAuth2\Server\Exception\UniqueTokenIdentifierConstraintViolationException;
use League\OAuth2\Server\Repositories\AuthCodeRepositoryInterface;

final class AuthCodeRepository implements AuthCodeRepositoryInterface
{
    /**
     * @param EntityRepository<AuthCode> $repo
     */
    public function __construct(private readonly EntityManagerInterface $em, private readonly EntityRepository $repo) {}

    public function getNewAuthCode(): AuthCode
    {
        return new AuthCode();
    }

    /**
     * @throws UniqueTokenIdentifierConstraintViolationException
     * @throws NonUniqueResultException
     * @throws NoResultException
     */
    public function persistNewAuthCode(AuthCodeEntityInterface $authCodeEntity): void
    {
        if ($this->exists($authCodeEntity->getIdentifier())) {
            throw UniqueTokenIdentifierConstraintViolationException::create();
        }

        $this->em->persist($authCodeEntity);
        $this->em->flush();
    }

    public function revokeAuthCode(string $codeId): void
    {
        if ($code = $this->repo->find($codeId)) {
            $this->em->remove($code);
            $this->em->flush();
        }
    }

    /**
     * @throws NonUniqueResultException
     * @throws NoResultException
     */
    public function isAuthCodeRevoked(string $codeId): bool
    {
        return !$this->exists($codeId);
    }

    /**
     * @throws NonUniqueResultException
     * @throws NoResultException
     */
    private function exists(string $id): bool
    {
        return $this->repo->createQueryBuilder('t')
            ->select('COUNT(t.identifier)')
            ->andWhere('t.identifier = :identifier')
            ->setParameter(':identifier', $id)
            ->getQuery()->getSingleScalarResult() > 0;
    }
}

<?php

declare(strict_types=1);

namespace App\Auth\Entity\User;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use DomainException;

class UserRepository
{
    private EntityRepository $repo;
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $repo = $em->getRepository(User::class);
        $this->repo = $repo;
        $this->em = $em;
    }

    /**
     * @throws NonUniqueResultException
     * @throws NoResultException
     */
    public function hasByEmail(Email $email): bool
    {
        return $this->repo->createQueryBuilder('t')
                ->select('COUNT(t.id)')
                ->andWhere('t.email = :email')
                ->setParameter(':email', $email->getValue())
                ->getQuery()->getSingleScalarResult() > 0;
    }

    /**
     * @throws NonUniqueResultException
     * @throws NoResultException
     */
    public function hasByNetwork(Network $network): bool
    {
        return $this->repo->createQueryBuilder('t')
                ->select('COUNT(t.id)')
                ->innerJoin('t.networks', 'n')
                ->andWhere('n.network.name = :name and n.network.identity = :identity')
                ->setParameter(':name', $network->getName())
                ->setParameter(':identity', $network->getIdentity())
                ->getQuery()->getSingleScalarResult() > 0;
    }

    public function findByJoinConfirmToken(string $token): User|null
    {
        /** @psalm-var User|null */
        return $this->repo->findOneBy(['joinConfirmToken.value' => $token]);
    }

    public function findByPasswordResetToken(string $token): ?User
    {
        /** @psalm-var User|null */
        return $this->repo->findOneBy(['passwordResetToken.value' => $token]);
    }

    public function findByNewEmailToken(string $token): ?User
    {
        /** @psalm-var User|null */
        return $this->repo->findOneBy(['newEmailToken.value' => $token]);
    }

    public function get(Id $id): User
    {
        if (!$user = $this->repo->find($id->getValue())) {
            throw new DomainException('User is not found.');
        }
        /** @var User $user */
        return $user;
    }
    public function getByEmail(Email $email): User
    {
        if (!$user = $this->repo->findOneBy(['email' => $email->getValue()])) {
            throw new DomainException('User is not found.');
        }
        /** @var User $user */
        return $user;
    }

    public function add(User $user): void
    {
        $this->em->persist($user);
    }

    public function remove(User $user): void
    {
        $this->em->remove($user);
    }
}

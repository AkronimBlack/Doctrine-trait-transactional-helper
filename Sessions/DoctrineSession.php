<?php
/**
 * Created by PhpStorm.
 * User: BlackBit
 * Date: 24-Nov-18
 * Time: 9:47
 */

namespace Transactional\Sessions;


use Doctrine\ORM\EntityManagerInterface;

class DoctrineSession implements TransactionalSession
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;

    }

    /**
     * {@inheritDoc}
     */
    public function executeAtomically(callable $operation)
    {
        return $this->entityManager->transactional($operation);
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: BlackBit
 * Date: 24-Nov-18
 * Time: 16:15
 */

namespace Transactional\Service;


use Transactional\Interfaces\TransactionalServiceInterface;
use Transactional\Sessions\DoctrineSession;
use Transactional\Sessions\TransactionalSession;

class TransactionService
{

    /**
     * @var TransactionalServiceInterface
     */
    private $service;
    /**
     * @var DoctrineSession
     */
    private $session;

    public function __construct(DoctrineSession $session)
    {
        $this->session = $session;
    }

    public function loadService(TransactionalServiceInterface $service): self
    {
        $this->service = $service;
        return $this;
    }

    public function overrideDefaultSession(TransactionalSession $session): self
    {
        $this->session = $session;
        return $this;
    }

    public function executeTransaction($request = null)
    {

        if (empty($this->service)) {
            throw new \LogicException('A use case must be specified');
        }

        $operation = function () use ($request) {
            return $this->service->execute($request);
        };

        return $this->session->executeAtomically($operation);
    }
}

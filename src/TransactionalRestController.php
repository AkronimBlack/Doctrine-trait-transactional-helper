<?php

namespace Transactional;


use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Transactional\Transactional;

class TransactionalRestController extends AbstractController
{
    use Transactional;

    protected $transaction;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->transaction = $this->createTransaction($entityManager);
    }

    public function runAsTransaction($service, $request)
    {
        return $this->transaction->loadService($service)->executeTransaction($request);
    }
}

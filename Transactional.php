<?php
/**
 * Created by PhpStorm.
 * User: BlackBit
 * Date: 26-Nov-18
 * Time: 18:20
 */

namespace Transactional;


use Doctrine\ORM\EntityManagerInterface;
use Transactional\Service\TransactionService;
use Transactional\Sessions\DoctrineSession;

trait Transactional
{
    /**
     * @var TransactionService
     */
    private $transactionService;

    /**
     * @param EntityManagerInterface $em
     *
     * @return TransactionService
     */
    public function createTransaction(EntityManagerInterface $em)
    {
        return new TransactionService(new DoctrineSession($em));
    }

}
<?php
/**
 * Created by PhpStorm.
 * User: BlackBit
 * Date: 24-Nov-18
 * Time: 9:58
 */

namespace Transactional\Interfaces;


interface TransactionalServiceInterface
{
    public function execute($request = null);
}
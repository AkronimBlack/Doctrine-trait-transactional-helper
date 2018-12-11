<?php
/**
 * Created by PhpStorm.
 * User: BlackBit
 * Date: 24-Nov-18
 * Time: 9:52
 */

namespace Transactional\Sessions;


interface TransactionalSession
{
    /**
     * @param  callable $operation
     * @return mixed
     */
    public function executeAtomically(callable $operation);

}
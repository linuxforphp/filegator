<?php

namespace Filegator\Services\Process;

use Filegator\Services\ServiceFactory;
use Symfony\Component\Process\Process;

class SymfonyProcessFactory implements ServiceFactory
{
    public function createService(array $params)
    {
        return new Process($params);
    }
}
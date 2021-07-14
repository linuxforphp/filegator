<?php

/*
 * This file is part of the FileGator package.
 *
 * (c) Milos Stojanovic <alcalbg@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE file
 */

namespace Tests\Unit;

use Filegator\Services\Process\SymfonyProcessFactory;
use Tests\TestCase;

/**
 * @internal
 */
class SymfonyProcessFactoryTest extends TestCase
{
    public function testCreatingASymfonyProcessWithSuccess()
    {
        $command[] = '/bin/true';
        $symfonyProcess = (new SymfonyProcessFactory())->createService($command);
        $symfonyProcess->start();

        while ($symfonyProcess->isRunning()) {
            // waiting for process to finish
        }

        $this->assertEquals('Symfony\Component\Process\Process', get_class($symfonyProcess));
        $this->assertEquals('\'/bin/true\'', $symfonyProcess->getCommandLine());
        $this->assertTrue($symfonyProcess->isSuccessful());
        $this->assertEquals(0, $symfonyProcess->getExitCode());
    }

    public function testCreatingASymfonyProcessWithFailure()
    {
        // Intended error
        $command[] = 'zip -r ' . TEST_DIR . DIR_SEP . 'fail.zip foo.txt bar.txt baz.txt';

        $symfonyProcess = (new SymfonyProcessFactory())->createService($command);
        $symfonyProcess->start();

        while ($symfonyProcess->isRunning()) {
            // waiting for process to finish
        }

        $this->assertEquals('Symfony\Component\Process\Process', get_class($symfonyProcess));
        $this->assertEquals('\'zip -r /srv/tempo/tests/backend/tmp/fail.zip foo.txt bar.txt baz.txt\'', $symfonyProcess->getCommandLine());
        $this->assertFalse($symfonyProcess->isSuccessful());
        $this->assertEquals(127, $symfonyProcess->getExitCode());
    }
}

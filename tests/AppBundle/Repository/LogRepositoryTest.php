<?php

namespace App\Test\AppBundle\Repository;

use App\AppBundle\Domain\Entity\Log;
use App\AppBundle\Infrastructure\Repository\LogRepository;
use RepositoryTestCase;

final class LogRepositoryTest extends RepositoryTestCase
{
    private LogRepository $logRepository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->logRepository = new LogRepository($this->registry);
    }

    /**
     * @testWith [true]
     *           [false]
     */
    public function testSave(bool $flush): void
    {
        $log = new Log();

        $this->em
            ->expects($this->once())
            ->method('persist')
            ->with($log);

        if ($flush) {
            $this->em
                ->expects($this->once())
                ->method('flush');

            $this->logRepository->save($log, $flush);

            return;
        }

        $this->em
            ->expects($this->never())
            ->method('flush');
        
        $this->logRepository->save($log);
    }

    /**
     * @testWith [true]
     *           [false]
     */
    public function testRemove(bool $flush): void
    {
        $log = new Log();

        $this->em
            ->expects($this->once())
            ->method('remove')
            ->with($log);

        if ($flush) {
            $this->em
                ->expects($this->once())
                ->method('flush');

            $this->logRepository->remove($log, $flush);

            return;
        }

        $this->em
            ->expects($this->never())
            ->method('flush');
        
        $this->logRepository->remove($log);
    }
}

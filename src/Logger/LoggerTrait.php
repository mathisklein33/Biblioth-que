<?php

declare(strict_types=1);


trait LoggerTrait
{
    private \LoggerInterface $logger;

    public function setLogger(\LoggerInterface $logger): void
    {
        $this->logger = $logger;
    }

    public function getLogger(): \LoggerInterface
    {
        return $this->logger;
    }
}

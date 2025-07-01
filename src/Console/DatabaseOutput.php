<?php

namespace Ebuyer\Totem\Console;

use Ebuyer\Totem\Result;
use Ebuyer\Totem\ResultStatus;
use Symfony\Component\Console\Output\Output;

class DatabaseOutput extends Output
{
    /**
     * @var Result
     */
    protected Result $result;

    /**
     * @var float
     */
    protected float $start;

    /**
     * @param Result $result
     * @param float $start
     */
    public function __construct(Result $result, float $start)
    {
        parent::__construct();
        $this->result = $result;
        $this->start = $start;
    }

    /**
     * @param string $message
     * @param bool $newline
     * @return void
     */
    protected function doWrite(string $message, bool $newline): void
    {
        $this->result->status = ResultStatus::RUNNING;
        $this->result->result .= $message . ($newline ? PHP_EOL : '');
        $this->result->duration = (microtime(true) - $this->start) * 1000;
        $this->result->save();
    }
}

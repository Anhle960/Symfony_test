<?php

namespace App\Logger;

use Monolog\Processor\ProcessorInterface;

class DateProcessor implements ProcessorInterface
{
    public function __invoke(\Monolog\LogRecord $record): \Monolog\LogRecord
    {
        $record->extra['date'] = date('Y-m-d');
        return $record;
    }
}

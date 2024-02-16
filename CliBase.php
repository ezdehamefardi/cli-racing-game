<?php

require 'vendor/autoload.php';

class CliBase
{
    public function showTable(array $header, array $data): void
    {
        $table = new \cli\Table();
        $table->setHeaders($header);
        $table->setRows($data);
        $table->setRenderer(new \cli\table\Ascii([10, 10, 20, 5]));
        $table->display();
    }

    public function simpleOutput(string $message, array $arguments = null): void
    {
        if ($arguments) {
            $arguments = implode(',', $arguments);
            \cli\out($message, $arguments);
        }
        \cli\out($message);
    }

    public function newlineOutput(string $message, array $arguments = null): void
    {
        if ($arguments) {
            $arguments = implode(',', $arguments);
            \cli\line($message, $arguments);
        }
        \cli\line($message);
    }
}
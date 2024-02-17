<?php

require 'vendor/autoload.php';

class CliBase
{
    public function showTable(array $header, array $data): void
    {
        $table = new \cli\Table();
        $table->setHeaders($header);
        $table->setRows($data);
        $table->setRenderer(new \cli\table\Ascii([5, 15, 10, 5]));
        $table->display();
    }

    public function simpleOutput(string $message, array $arguments = null): void
    {
        if ($arguments) {    
            array_unshift($arguments, $message);
            call_user_func_array("\cli\out", $arguments);        
        } else {
            \cli\out($message);
        }
    }

    public function newlineOutput(string $message, array $arguments = null): void
    {
        if ($arguments) { 
            array_unshift($arguments, $message);   
            call_user_func_array("\cli\line", $arguments);
        } else {
            \cli\line($message);
        }
    }

    public function notify(cli\Notify $notify, $cycle = 10000000, $sleep = null): void
    {
        for ($i = 0; $i < $cycle; $i++) {
            $notify->tick();
            if ($sleep) usleep($sleep);
        }
        $notify->finish();
    }

    public function notifyMessage(cli\Notify $notify, $cycle = 1000000, $sleep = null, $player): void
    {
        $notify->display();
        for ($i = 0; $i < $cycle; $i++) {
            if ($sleep) usleep($sleep);
            $msg = sprintf('  Player %s racing time %d minutes', $player, $i + 1);
            $notify->tick(1, $msg);
        }
        $notify->finish();    
    }

    public function colorizedOutput(string $message, array $arguments = null): void
    {
        \cli\Colors::enable();
        if ($arguments) { 
            array_unshift($arguments, "\n".'  %C%5'.$message.'%n');   
            call_user_func_array("\cli\line", $arguments);
        } else {
            \cli\line("\n".'  %C%5'.$message.'%n');
        }
        \cli\Colors::disable();
    }
}
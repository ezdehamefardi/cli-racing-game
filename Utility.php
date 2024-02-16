<?php

include 'CliBase.php';
include 'Constant.php';

class Utility
{
    private $cli;
    private $constant;

    public function __construct()
    {
        $this->cli = new CliBase();
        $this->constant = new Constant();
    }

    public function initial(): void
    {
        $this->cli->simpleOutput($this->constant->getWelcomeMessage());
        $this->cli->newlineOutput('');
        $this->vehiclesList();
    }

    private function vehiclesList(): void
    {
        $header = $this->constant->getTableHeader();
        $vehiclesFile = json_decode(file_get_contents('vehicles.json'), true);
        $vehiclesArray = $this->prepareJsonData($vehiclesFile);
        $this->cli->showTable($header, $vehiclesArray);
    }

    private function prepareJsonData($data): array
    {
        $result = [];

        foreach ($data as $item) {
            $row = [];
            foreach ($item as $value) {
                $row[] = $value;
            }
            $result[] = $row;
        }

        return $result;
    }
}
<?php

include 'CliBase.php';
include 'Constant.php';
include 'Utility.php';

class Race extends Utility
{
    private $cli;
    private $constant;
    private $utility;
    private $playerOneChoice;
    private $playerTwoChoice;
    private $vehiclesFile;
    private $vehiclesArray;


    public function __construct()
    {
        $this->cli = new CliBase();
        $this->constant = new Constant();
        $this->vehiclesFile = json_decode(file_get_contents('vehicles.json'), true);
        $this->vehiclesArray = $this->prepareJsonData($this->vehiclesFile);
    }

    public function initial(): void
    {
        $this->cli->simpleOutput($this->constant->getWelcomeMessage());
        $this->vehiclesList();
    }

    public function getPlayerInput(string $player, $isFirstAttempt = true): void
    {
        if ($isFirstAttempt)
            $this->cli->newlineOutput($this->constant->getChooseMessage(), ['Player '.$player]);

        //get input, validate and assign selected value to class
        $playerInput = fgets(STDIN);
        if ($this->validateUserInput($playerInput)) {            
            $this->cli->newlineOutput($this->constant->getShowSelectedVehicleMessage(), $this->vehiclesArray[($playerInput-1)]);
            if ($player == 'one') {
                $this->playerOneChoice = $playerInput;
            } else {
                $this->playerTwoChoice = $playerInput;
            }        
        } else {
            $this->cli->newlineOutput($this->constant->getWrongInputMessage());
            $this->getPlayerInput($player, false);
        }
    }

    private function vehiclesList(): void
    {
        $header = $this->constant->getTableHeader();        
        $this->cli->showTable($header, $this->vehiclesArray);
    }
}
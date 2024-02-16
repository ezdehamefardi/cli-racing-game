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

    
    /*
    * Show list and welcome message to players
    */
    public function initial(): void
    {
        $this->cli->simpleOutput($this->constant->getWelcomeMessage());
        $this->vehiclesList();
    }

    /*
    * get input, validate and assign selected value to class
    */
    public function getPlayerInput(string $player, $isFirstAttempt = true): void
    {
        if ($isFirstAttempt)
            $this->cli->newlineOutput($this->constant->getChooseMessage(), ['Player '.$player]);

        $playerInput = $this->formatUserInputs(fgets(STDIN));
        if ($this->validateUserInput($playerInput)) {            
            $this->cli->newlineOutput($this->constant->getShowSelectedVehicleMessage(), $this->vehiclesArray[($playerInput-1)]);
            $player == 'one' ? 
                $this->playerOneChoice = $playerInput-1 :
                $this->playerTwoChoice = $playerInput-1;       
        } else {
            $this->cli->newlineOutput($this->constant->getWrongInputMessage());
            $this->getPlayerInput($player, false);
        }
    }

    /*
    * Calculate racing time for each vehicle and show the racing time 
    */
    public function startRacing(): void
    {
        $playerOneChoice = $this->vehiclesFile[$this->playerOneChoice];
        $playerOneTotalTime = $this->timeCalculator($playerOneChoice['maxSpeed'], $playerOneChoice['unit']);
        $this->cli->newlineOutput($this->constant->getTimeSpendMessage(), ['One', $playerOneChoice['name'], $playerOneTotalTime]);

        $playerTwoChoice = $this->vehiclesFile[$this->playerTwoChoice];
        $playerTwoTotalTime = $this->timeCalculator($playerTwoChoice['maxSpeed'], $playerTwoChoice['unit']);
        $this->cli->newlineOutput($this->constant->getTimeSpendMessage(), ['Two', $playerTwoChoice['name'], $playerTwoTotalTime]);
    }

    private function vehiclesList(): void
    {
        $header = $this->constant->getTableHeader();        
        $this->cli->showTable($header, $this->vehiclesArray);
    }
}
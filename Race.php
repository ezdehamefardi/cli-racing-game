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
    private $playerOneTotalTime;
    private $playerTwoTotalTime;
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
        $this->cli->newlineOutput('');
        $this->cli->colorizedOutput($this->constant->getGameName());
        $this->cli->newlineOutput('');
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
                $this->playerOneChoice = $this->vehiclesFile[$playerInput-1] :
                $this->playerTwoChoice = $this->vehiclesFile[$playerInput-1];       
        } else {
            $this->cli->newlineOutput($this->constant->getWrongInputMessage());
            $this->getPlayerInput($player, false);
        }
    }

    /*
    * Calculate racing time for each vehicle and start competition
    */
    public function startRacing(): void
    {
        // calculation
        $this->playerOneTotalTime = $this->timeCalculator($this->playerOneChoice['maxSpeed'], $this->playerOneChoice['unit']);        
        $this->playerTwoTotalTime = $this->timeCalculator($this->playerTwoChoice['maxSpeed'], $this->playerTwoChoice['unit']);
    
        // show progress bar
        $this->cli->notifyMessage(new \cli\progress\Bar('  Player One', $this->playerOneTotalTime), $this->playerOneTotalTime, 1000000, "one");
        $this->cli->notifyMessage(new \cli\progress\Bar('  Player Two', $this->playerTwoTotalTime), $this->playerTwoTotalTime, 1000000, "two");
    }

    /*
    * Show scoreboard
    */
    public function scoreBoard(): void
    {
        $this->cli->newlineOutput($this->constant->getScoreBoardTitleMessage());

        // display results
        $this->cli->newlineOutput("\n");
        $this->cli->newlineOutput($this->constant->getTimeSpendMessage(), ['One', $this->playerOneChoice['name'], $this->playerOneTotalTime]);
        $this->cli->newlineOutput($this->constant->getTimeSpendMessage(), ['Two', $this->playerTwoChoice['name'], $this->playerTwoTotalTime]);

        //display winner
        if ($this->playerOneTotalTime == $this->playerTwoTotalTime) {
            $winner = "Boath of player One and Two";
        } else {
            $winner = $this->playerOneTotalTime > $this->playerTwoTotalTime ? 'Two' : "One";
        }        

        $this->cli->colorizedOutput($this->constant->getWinnerMessage(), [$winner]);
    }    

    private function vehiclesList(): void
    {
        $header = $this->constant->getTableHeader();        
        $this->cli->showTable($header, $this->vehiclesArray);
    }
}
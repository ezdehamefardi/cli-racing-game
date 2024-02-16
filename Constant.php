<?php

class Constant
{
    private $tableHeader = ['id', 'Name', 'Max Speed', 'Unit'];
    private $welcomeMessage = " This is two-player racing game. The game begins with the players choosing a vehicle from a below list \n The length of the race will be 20 km and the vehicle that completes this route the fastest will be the winner of the race \n GoodLuck! \n\n";
    private $gameName = "Racing Game";
    private $chooseMessage = " Dear %s, \n Please select one of Vehicles displayed in table abow: ";
    private $waitingMessage = " Race will be start soon, Joy it...";
    private $endingRaceMessage = " The competition is over... the result of the competition:";
    private $winnerMessage = " The winner of this match is the %s";
    private $wrongInputMessage = " The selected vehicle is not valid! please select a valid one (1-10):";
    private $showSelectedVehicleMessage = " Nice! Your select number %s that is '%s' With amazing '%s %s' speed! \n\n";
    private $timeSpendMessage = " Player %s completed the race with vehicle %s in %s minutes\n ";

    public function getTableHeader(): array
    {
        return $this->tableHeader;
    }

    public function getWelcomeMessage(): string
    {
        return $this->welcomeMessage;
    }

    public function getGameName(): string
    {
        return $this->gameName;
    }

    public function getChooseMessage(): string
    {
        return $this->chooseMessage;
    }

    public function getWaitingMessage(): string
    {
        return $this->waitingMessage;
    }

    public function getWinnerMessage(): string
    {
        return $this->winnerMessage;
    }

    public function getWrongInputMessage(): string
    {
        return $this->wrongInputMessage;
    }

    public function getShowSelectedVehicleMessage(): string
    {
        return $this->showSelectedVehicleMessage;
    }

    public function getTimeSpendMessage(): string
    {
        return $this->timeSpendMessage;
    }
}
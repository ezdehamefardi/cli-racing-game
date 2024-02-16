<?php

class Constant
{
    private $tableHeader = ['Name', 'Max Speed', 'Unit'];
    private $welcomeMessage = "This is two-player racing game. The game begins with the players choosing a vehicle from a below list \n GoodLuck!";
    private $gameName = "Racing Game";
    private $chooseMessage = "Dear %s, \n Please select one of Vehicles displayed in table abow";
    private $waitingMessage = "Race will be start soon, Joy it...";

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
}
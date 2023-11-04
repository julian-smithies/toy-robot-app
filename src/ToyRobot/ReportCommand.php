<?php
namespace Julian\ToyRobotApp\ToyRobot;

class ReportCommand extends ToyRobotCommand
{
    public function execute() : void
    {
        $xPosition = $this->toyRobot->getXPosition();
        $yPosition = $this->toyRobot->getYPosition();
        $direction = $this->toyRobot->getDirection();

        echo("<br>Output: " . implode(',', [
            $xPosition,
            $yPosition,
            $direction->value
        ]));
    }

    public function canExecute(): bool
    {
        return $this->toyRobot->hasBeenPlaced();
    }
}
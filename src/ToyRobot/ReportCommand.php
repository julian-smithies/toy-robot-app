<?php
namespace Julian\ToyRobotApp\ToyRobot;

class ReportCommand extends ToyRobotCommand
{
    public function execute(): void
    {
        $xPosition = $this->toyRobot->getXPosition();
        $yPosition = $this->toyRobot->getYPosition();
        $direction = $this->toyRobot->getDirection();

        echo ("Output: " . implode(',', [
            $xPosition,
            $yPosition,
            $direction->value
        ]) . "\n");
    }

    public function canExecute(): bool
    {
        return $this->toyRobot->hasBeenPlaced();
    }
}
<?php
class ReportCommand extends ToyRobotCommand
{
    public function execute() : void
    {
        $xPosition = $this->toyRobot->getXPosition();
        $yPosition = $this->toyRobot->getYPosition();
        $direction = $this->toyRobot->getDirection();

        echo(implode(',', [
            $xPosition,
            $yPosition,
            $direction
        ]));
    }
}
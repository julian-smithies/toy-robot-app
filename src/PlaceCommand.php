<?php

class PlaceCommand extends ToyRobotCommand
{
    private int $xPosition;
    private int $yPosition;
    private Direction $direction;

    public function __construct(int $xPosition, int $yPosition, Direction $direction)
    {
        $this->$xPosition = $xPosition;
        $this->$yPosition = $yPosition;
        $this->$direction = $direction;
    }

    public function execute() : void
    {
        $this->toyRobot->setPosition($this->xPosition, $this->yPosition);
        $this->toyRobot->setDirection($this->direction);
    }
}
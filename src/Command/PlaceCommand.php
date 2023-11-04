<?php
namespace Julian\ToyRobot\Command;

use Julian\ToyRobot\Direction;
use Julian\ToyRobot\ToyRobot;

class PlaceCommand extends ToyRobotCommand
{
    private int $xPosition;
    private int $yPosition;
    private Direction $direction;

    public function __construct(ToyRobot $toyRobot, int $xPosition, int $yPosition, Direction $direction)
    {
        parent::__construct($toyRobot);
        $this->$xPosition = $xPosition;
        $this->$yPosition = $yPosition;
        echo(print_r($direction, 1));

        $this->$direction = $direction;
    }

    public function execute() : void
    {
        $this->toyRobot->setPosition($this->xPosition, $this->yPosition);
        $this->toyRobot->setDirection($this->direction);
    }
}
<?php
namespace Julian\ToyRobot\Command;

use Julian\ToyRobot\Direction;
use Julian\ToyRobot\ToyRobot;

class PlaceCommand extends ToyRobotCommand
{
    private int $xPosition;
    private int $yPosition;
    private Direction $direction;

    public function __construct(ToyRobot $toyRobot, int $xPosition, int $yPosition, Direction|string $direction)
    {
        parent::__construct($toyRobot);
        $this->xPosition = $xPosition;
        $this->yPosition = $yPosition;
        $this->direction = $direction instanceof Direction ? $direction : Direction::from($direction);
    }

    public function execute() : void
    {
        $this->toyRobot->setPosition($this->xPosition, $this->yPosition);
        $this->toyRobot->setDirection($this->direction);
    }
}
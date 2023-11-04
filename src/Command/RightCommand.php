<?php
namespace Julian\ToyRobot\Command;

use Julian\ToyRobot\Direction;

class RightCommand extends ToyRobotCommand
{
    public function execute(): void
    {
        $currentDirection = $this->toyRobot->getDirection();

        $this->toyRobot->setDirection(match ($currentDirection) {
            Direction::NORTH => Direction::EAST,
            Direction::SOUTH => Direction::WEST,
            Direction::EAST => Direction::SOUTH,
            Direction::WEST => Direction::NORTH,
        });
    }
}

<?php
namespace Julian\ToyRobotApp\ToyRobot;

use Julian\ToyRobotApp\Generic\Direction;

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

    public function canExecute(): bool
    {
        return $this->toyRobot->hasBeenPlaced();
    }
}

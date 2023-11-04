<?php
class LeftCommand extends ToyRobotCommand
{
    public function execute(): void
    {
        $currentDirection = $this->toyRobot->getDirection();

        $this->toyRobot->setDirection(match ($currentDirection) {
            Direction::NORTH => Direction::WEST,
            Direction::SOUTH => Direction::EAST,
            Direction::EAST => Direction::NORTH,
            Direction::WEST => Direction::SOUTH,
        });
    }
}
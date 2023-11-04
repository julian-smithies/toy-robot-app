<?php

class MoveCommand extends ToyRobotCommand
{
    public function execute() : void
    {
        $xDestination = $this->toyRobot->getXPosition();
        $yDestination = $this->toyRobot->getYPosition();
        $moveDirection = $this->toyRobot->getDirection();

        switch($moveDirection)
        {
            case Direction::NORTH:
                $yDestination += 1;
                break;
            case Direction::SOUTH:
                $yDestination -= 1;
                break;
            case Direction::EAST:
                $xDestination += 1;
                break;
            case Direction::WEST:
                $xDestination -= 1;
                break;
        }

        $this->toyRobot->setPosition($xDestination, $yDestination);
    }
}
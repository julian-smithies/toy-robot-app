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
                $yDestination++;
                break;
            case Direction::SOUTH:
                $yDestination--;
                break;
            case Direction::EAST:
                $xDestination++;
                break;
            case Direction::WEST:
                $xDestination--;
                break;
        }

        $this->toyRobot->setPosition($xDestination, $yDestination);
    }
}
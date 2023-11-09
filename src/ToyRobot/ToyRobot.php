<?php
namespace Julian\ToyRobotApp\ToyRobot;

use Julian\ToyRobotApp\Generic\Direction;
use Julian\ToyRobotApp\Generic\Table;

class ToyRobot
{
    private int $xPosition;
    private int $yPosition;
    private Direction $direction;

    public function getXPosition()
    {
        return $this->xPosition;
    }
    public function getYPosition()
    {
        return $this->yPosition;
    }
    public function getDirection()
    {
        return $this->direction;
    }

    public function setPosition(int $xPosition, int $yPosition)
    {
        $this->xPosition = $xPosition;
        $this->yPosition = $yPosition;
    }

    public function setDirection(Direction $direction)
    {
        $this->direction = $direction;
    }

    public function hasBeenPlaced(): bool
    {
        return isset(
            $this->xPosition,
            $this->yPosition,
            $this->direction
        );
    }

    public function hasSpaceToMove(Table $table)
    {
        return match ($this->direction) {
            Direction::NORTH => $this->yPosition < $table->getYDimension(),
            Direction::SOUTH => $this->yPosition > 1,
            Direction::EAST => $this->xPosition < $table->getXDimension(),
            Direction::WEST => $this->xPosition > 1
        };
    }
}
?>
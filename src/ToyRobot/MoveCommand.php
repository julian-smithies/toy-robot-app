<?php
namespace Julian\ToyRobotApp\ToyRobot;

use Julian\ToyRobotApp\Generic\Direction;
use Julian\ToyRobotApp\Generic\Table;

class MoveCommand extends ToyRobotCommand
{
    private Table $table;

    public function __construct(ToyRobot $toyRobot, Table $table)
    {
        parent::__construct($toyRobot);
        $this->table = $table;
    }

    public function execute(): void
    {
        $xDestination = $this->toyRobot->getXPosition();
        $yDestination = $this->toyRobot->getYPosition();
        $moveDirection = $this->toyRobot->getDirection();

        switch ($moveDirection) {
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

    public function canExecute(): bool
    {
        return $this->toyRobot->hasBeenPlaced()
            && $this->toyRobot->hasSpaceToMove($this->table);
    }
}
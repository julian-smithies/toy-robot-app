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

        match ($moveDirection) {
            Direction::NORTH => $yDestination++,
            Direction::SOUTH => $yDestination--,
            Direction::EAST => $xDestination++,
            Direction::WEST => $xDestination--,
        };

        $this->toyRobot->setPosition($xDestination, $yDestination);
    }

    public function canExecute(): bool
    {
        return $this->toyRobot->hasBeenPlaced()
            && $this->toyRobot->hasSpaceToMove($this->table);
    }
}
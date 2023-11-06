<?php
namespace Julian\ToyRobotApp\ToyRobot;

use Julian\ToyRobotApp\Generic\Direction;
use Julian\ToyRobotApp\Generic\Table;

class PlaceCommand extends ToyRobotCommand
{
    private Table $table;
    private int $xPosition;
    private int $yPosition;
    private Direction $direction;

    public function __construct(ToyRobot $toyRobot, Table $table, int $xPosition, int $yPosition, Direction|string $direction)
    {
        parent::__construct($toyRobot);
        $this->table = $table;
        $this->xPosition = $xPosition;
        $this->yPosition = $yPosition;
        $this->direction = $direction instanceof Direction ? $direction : Direction::from($direction);
    }

    public function execute(): void
    {
        $this->toyRobot->setPosition($this->xPosition, $this->yPosition);
        $this->toyRobot->setDirection($this->direction);
    }

    public function canExecute(): bool
    {
        return $this->xPosition >= 0
            && $this->xPosition <= $this->table->getXDimension()
            && $this->yPosition >= 0
            && $this->yPosition <= $this->table->getYDimension();
    }
}
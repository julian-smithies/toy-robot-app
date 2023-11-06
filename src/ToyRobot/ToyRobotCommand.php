<?php
namespace Julian\ToyRobotApp\ToyRobot;

use Julian\ToyRobotApp\Command\Command;

abstract class ToyRobotCommand implements Command
{
    protected ToyRobot $toyRobot;

    public function __construct(ToyRobot $toyRobot)
    {
        $this->toyRobot = $toyRobot;
    }

    public abstract function execute(): void;

    public function canExecute(): bool
    {
        return true;
    }
}
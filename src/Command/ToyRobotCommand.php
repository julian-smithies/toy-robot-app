<?php
namespace Julian\ToyRobot\Command;

use Julian\ToyRobot\ToyRobot;

abstract class ToyRobotCommand implements Command
{
    protected ToyRobot $toyRobot;

    public function __construct(ToyRobot $toyRobot)
    {
        $this->toyRobot = $toyRobot;
    }
    
    public function execute(): void
    {

    }
}
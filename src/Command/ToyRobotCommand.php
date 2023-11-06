<?php
namespace Julian\ToyRobot\Command;

use Julian\ToyRobot\ToyRobot;

abstract class ToyRobotCommand implements Command
{
    const COMMAND_REGEX = '/^(PLACE \d+,\d+,(NORTH|SOUTH|EAST|WEST)|MOVE|LEFT|RIGHT|REPORT)$/';

    protected ToyRobot $toyRobot;

    public function __construct(ToyRobot $toyRobot)
    {
        $this->toyRobot = $toyRobot;
    }
    
    abstract function execute(): void;
}
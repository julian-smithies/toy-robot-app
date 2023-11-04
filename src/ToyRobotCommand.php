<?php

use Julian\ToyRobot\Command;

abstract class ToyRobotCommand implements Command
{
    protected ToyRobot $toyRobot;
    
    public function execute(): void
    {
        
    }
}
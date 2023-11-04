<?php
namespace Julian\ToyRobot\Command;

class InvalidCommand implements Command
{
    public function __construct() {}

    public function execute(): void
    {
        echo("Cannot execute invalid command");
    }
}

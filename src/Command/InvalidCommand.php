<?php
namespace Julian\ToyRobot\Command;

class InvalidCommand implements Command
{
    private string $commandString;

    public function __construct(string $commandString = '') {
        $this->commandString = $commandString;
    }

    public function execute(): void
    {
        echo("Cannot execute invalid command: " . $this->commandString);
    }

    public function canExecute(): bool
    {
        return false;
    }
}

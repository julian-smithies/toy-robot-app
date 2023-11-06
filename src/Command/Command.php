<?php
namespace Julian\ToyRobot\Command;

interface Command
{
    public function execute(): void;
    public function canExecute(): bool;
}
?>
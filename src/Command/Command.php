<?php
namespace Julian\ToyRobotApp\Command;

interface Command
{
    public function execute(): void;
    public function canExecute(): bool;
}
?>
<?php
namespace Julian\ToyRobotApp\ToyRobot;

use Julian\ToyRobotApp\Command\CommandInvoker;
use Julian\ToyRobotApp\Generic\Table;

class ToyRobotCommandQueue
{
    private ToyRobot $toyRobot;
    private Table $table;
    private array $commands;
    private int $commandsExecuted;

    public function getCommandsExecuted()
    {
        return $this->commandsExecuted;
    }

    public function __construct(ToyRobot $toyRobot, Table $table, array $commands = [])
    {
        $this->toyRobot = $toyRobot;
        $this->table = $table;
        $this->commands = $commands;
    }

    public function importCommandsFromFile($file)
    {
        $commandStrings = file($file, FILE_IGNORE_NEW_LINES);
        foreach ($commandStrings as $commandString) {
            $this->addCommandFromString(trim($commandString));
        }
    }

    public function addCommandFromString(string $commandString)
    {
        $parser = new ToyRobotCommandParser($this->toyRobot, $this->table);
        $command = $parser->parse($commandString);
        $this->addCommand($command);
    }

    public function addCommand(ToyRobotCommand $command)
    {
        array_push($this->commands, $command);
    }

    public function invokeCommands()
    {
        $this->resetCommandsExecuted();

        $invoker = new CommandInvoker();
        foreach ($this->commands as $command) {
            $invoker->invoke($command);
            if ($invoker->commandWasExecuted()) {
                $this->commandsExecuted++;
            }
        }
    }

    private function resetCommandsExecuted()
    {
        $this->commandsExecuted = 0;
    }


}
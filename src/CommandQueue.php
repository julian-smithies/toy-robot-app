<?php
namespace Julian\ToyRobot;

use Julian\ToyRobot\Command\Command;
use Julian\ToyRobot\Command\InvalidCommand;
use Julian\ToyRobot\Command\LeftCommand;
use Julian\ToyRobot\Command\MoveCommand;
use Julian\ToyRobot\Command\PlaceCommand;
use Julian\ToyRobot\Command\ReportCommand;
use Julian\ToyRobot\Command\RightCommand;
use Julian\ToyRobot\Command\ToyRobotCommand;
use Julian\ToyRobot\ToyRobot;

class CommandQueue 
{
    private ToyRobot $toyRobot;
    private Table $table;
    private array $commands;
    private int $commandsExecuted;

    public function getCommandsExecuted() { return $this->commandsExecuted; }

    public function __construct(ToyRobot $toyRobot, Table $table, array $commands = [])
    {
        $this->toyRobot = $toyRobot;
        $this->table = $table;
        $this->commands = $commands;
    }

    public function importFromFile($file) {
        $commandStrings = file($file, FILE_IGNORE_NEW_LINES);
        foreach($commandStrings as $commandString) {
            $this->addCommandFromString(trim($commandString));
        }
    }

    public function addCommandFromString(string $commandString)
    {
        if (!$this->commandStringIsValid($commandString)) {
            $this->addCommand(
                new InvalidCommand($commandString)
            );
            return;
        }

        $command = match (0) {
            strpos($commandString, 'PLACE') => new PlaceCommand(
                $this->toyRobot,
                $this->table,
                ...explode(",", explode(" ", $commandString)[1])
            ),
            strpos($commandString, 'MOVE') => new MoveCommand(
                $this->toyRobot,
                $this->table
            ),
            strpos($commandString, 'LEFT') => new LeftCommand(
                $this->toyRobot
            ),
            strpos($commandString, 'RIGHT') => new RightCommand(
                $this->toyRobot
            ),
            strpos($commandString, 'REPORT') => new ReportCommand(
                $this->toyRobot
            )
        };

        $this->addCommand($command);
    }

    public function addCommand(Command $command)
    {
        array_push($this->commands, $command);
    }

    public function invokeCommands()
    {
        $this->resetCommandsExecuted();

        $invoker = new CommandInvoker();
        foreach ($this->commands as $command) {
            $invoker->invoke($command);
            if($invoker->commandWasExecuted()) {
                $this->commandsExecuted++;
            }
        }
    }

    private function resetCommandsExecuted() {
        $this->commandsExecuted = 0;
    }

    public function commandStringIsValid($commandString)
    {
        return preg_match(ToyRobotCommand::COMMAND_REGEX, $commandString);
    }
}
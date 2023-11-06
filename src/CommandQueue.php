<?php
namespace Julian\ToyRobot;

use Julian\ToyRobot\Command\Command;
use Julian\ToyRobot\Command\InvalidCommand;
use Julian\ToyRobot\Command\LeftCommand;
use Julian\ToyRobot\Command\MoveCommand;
use Julian\ToyRobot\Command\PlaceCommand;
use Julian\ToyRobot\Command\ReportCommand;
use Julian\ToyRobot\Command\RightCommand;
use Julian\ToyRobot\ToyRobot;

class CommandQueue 
{
    private ToyRobot $toyRobot;
    private array $commands;

    public function __construct(ToyRobot $toyRobot, array $commands = [])
    {
        $this->toyRobot = $toyRobot;
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

            strpos($commandString, 'PLACE') => new PlaceCommand(
                $this->toyRobot, ...explode(",", explode(" ", $commandString)[1])
            ),
            strpos($commandString, 'MOVE') => new MoveCommand(
                $this->toyRobot
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

    public function commandStringIsValid($commandString)
    {
        return preg_match(ToyRobotCommand::COMMAND_REGEX, $commandString);
    }
}
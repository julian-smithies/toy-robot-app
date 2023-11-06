<?php
namespace Julian\ToyRobotApp\ToyRobot;

use Julian\ToyRobotApp\Command\Command;
use Julian\ToyRobotApp\Command\InvalidCommand;
use Julian\ToyRobotApp\Generic\Table;

class ToyRobotCommandParser
{
    const COMMAND_SYNTAX_REGEX = '/^(PLACE \d+,\d+,(NORTH|SOUTH|EAST|WEST)|MOVE|LEFT|RIGHT|REPORT)$/';
    private ToyRobot $toyRobot;
    private Table $table;

    public function __construct(ToyRobot $toyRobot, Table $table)
    {
        $this->toyRobot = $toyRobot;
        $this->table = $table;
    }

    public function parse(string $commandString): Command
    {
        if (!$this->commandStringIsValid($commandString)) {
            return new InvalidCommand($commandString);
        }

        return match (0) {
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
    }

    public function commandStringIsValid($commandString)
    {
        return preg_match(self::COMMAND_SYNTAX_REGEX, $commandString);
    }
}
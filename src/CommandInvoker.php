<?php
namespace Julian\ToyRobot;

use Julian\ToyRobot\Command\Command;

class CommandInvoker
{
    private $commandExecuted = false;

    public function invoke(Command $command)
    {
        if($command->canExecute()) {
            $command->execute();
            $this->commandExecuted = true;
        }
    }

    public function commandWasExecuted():bool {
        return $this->commandExecuted;
    }
}

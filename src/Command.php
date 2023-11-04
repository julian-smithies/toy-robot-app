<?php

namespace Julian\ToyRobot;

interface Command
{
    public function execute(): void;
}
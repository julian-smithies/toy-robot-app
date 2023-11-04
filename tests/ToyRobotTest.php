<?php
use PHPUnit\Framework\TestCase;
use Julian\ToyRobot\Command\MoveCommand;
use Julian\ToyRobot\Command\PlaceCommand;
use Julian\ToyRobot\Direction;
use Julian\ToyRobot\ToyRobot;

final class ToyRobotTest extends TestCase {
    function testRobotCanBePlaced() {
        $xPosition = 3;
        $yPosition = 3;
        $direction = Direction::NORTH;
        $robot = new ToyRobot();

        $command = new PlaceCommand($robot, $xPosition, $yPosition, $direction);
        $command->execute();

        $this->assertEquals($robot->getXPosition(), $xPosition);
        $this->assertEquals($robot->getYPosition(), $yPosition);
        $this->assertEquals($robot->getDirection(), $direction);
    }

    function testRobotCanMove() {
        $robot = new ToyRobot();

        $robot->setPosition(2, 2);
        $robot->setDirection(Direction::NORTH);

        $command = new MoveCommand($robot);
        $command->execute();

        $this->assertEquals($robot->getYPosition(), 3);
    }
}
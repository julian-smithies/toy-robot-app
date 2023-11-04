<?php
    class ToyRobot {
        private int $xPosition;
        private int $yPosition;
        private Direction $direction;

        public function __construct()
        {
            echo('Toy Robot... booting up...');
        }

        public function getXPosition() { return $this->xPosition; }
        public function getYPosition() { return $this->yPosition; }
        public function getDirection() { return $this->direction; }

        public function setPosition(int $xPosition, int $yPosition)
        {
            $this->$xPosition = $xPosition;
            $this->$yPosition = $yPosition;
        }

        public function setDirection(Direction $direction) 
        {
            $this->direction = $direction;
        }

        public function isOn(Table $table) : bool
        {
            return $this->xPosition >= 1
                && $this->xPosition <= $table->getXDimension()
                && $this->yPosition >= 1
                && $this->yPosition <= $table->getYDimension();
        }
    }
?>
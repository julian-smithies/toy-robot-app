<?php
namespace Julian\ToyRobot;

class Table
{
    private int $xDimension;
    private int $yDimension;
    
    public function __construct(int $xDimension, int $yDimension) {
        $this->setXDimension($xDimension);
        $this->setYDimension($yDimension);
    }

    public function getXDimension() { return $this->xDimension; }
    public function getYDimension() { return $this->yDimension; }

    public function setXDimension(int $xDimension) {
        $this->xDimension = max(1, $xDimension);
    }

    public function setYDimension(int $yDimension) {
        $this->yDimension = max(1, $yDimension);
    }
}
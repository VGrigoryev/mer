<?php declare(strict_types = 1);

namespace Mars;

/**
 * Class ControlPanel
 * @package Mars
 */
class ControlPanel
{
    private $input;

    public function __construct($input)
    {
        $this->input = trim($input);
    }

    /**
     * Run commands received from the Earth
     */
    public function run()
    {
        $commands = explode("\n", $this->input);
        array_shift($commands);

        while ($command = array_shift($commands)) {
            list($x, $y, $orientation) = explode(' ', $command);
            $roverCommandString = array_shift($commands);

            $rover = new Rover((int)$x, (int)$y, $orientation);
            $rover->execute($roverCommandString);

            echo sprintf("%s\n", $rover);
        }
    }
}
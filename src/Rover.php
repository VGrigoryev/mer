<?php declare(strict_types = 1);

namespace Mars;

/**
 * Class Rover
 * @package Mars
 */
class Rover
{
    const MOVE = 'M';
    const ROTATION_LEFT = 'L';
    const ROTATION_RIGHT = 'R';

    const DIRECTION_NORTH = 'N';
    const DIRECTION_EAST = 'E';
    const DIRECTION_SOUTH = 'S';
    const DIRECTION_WEST = 'W';

    const AVAILABLE_DIRECTION = [self::DIRECTION_NORTH, self::DIRECTION_EAST, self::DIRECTION_SOUTH, self::DIRECTION_WEST];

    private $x;
    private $y;

    private $direction;

    /**
     * @param int $x Initial position by X
     * @param int $y Initial position by Y
     * @param string $direction Initial direction
     *
     * @throws \Exception
     */
    public function __construct(int $x, int $y, string $direction)
    {
        $this->x = $x;
        $this->y = $y;

        if (!in_array($direction, self::AVAILABLE_DIRECTION)) {
            throw new \Exception('Wrong direction');
        }

        $this->direction = $direction;
    }

    /**
     * Executes commands
     *
     * @param string $commandString
     */
    public function execute(string $commandString)
    {
        $commands = str_split($commandString);

        foreach ($commands as $command) {
            if ($command == self::MOVE) {
                $this->move();
                continue;
            }
            if (in_array($command, [self::ROTATION_LEFT, self::ROTATION_RIGHT])) {
                $this->rotate($command);
            }
        }
    }

    /**
     * Returns current coordinates and direction
     *
     * @return string
     */
    public function __toString()
    {
        return sprintf('%d %d %s', $this->x, $this->y, $this->direction);
    }

    /**
     * Move the Rover in a current direction
     */
    private function move(): void
    {
        switch ($this->direction) {
            case self::DIRECTION_NORTH:
                $this->y += 1;
                break;
            case self::DIRECTION_EAST:
                $this->x += 1;
                break;
            case self::DIRECTION_SOUTH:
                $this->y -= 1;
                break;
            case self::DIRECTION_WEST:
                $this->x -= 1;
                break;
        }
    }

    /**
     * Rotate the Rover
     *
     * @param string $direction
     */
    private function rotate(string $direction): void
    {
        $k = array_search($this->direction, self::AVAILABLE_DIRECTION);

        if ($direction == 'L') {
            $this->direction = self::AVAILABLE_DIRECTION[($k - 1 >= 0 ? $k - 1 : count(self::AVAILABLE_DIRECTION) - 1)];
        }
        if ($direction == 'R') {
            $this->direction = self::AVAILABLE_DIRECTION[($k + 1 < count(self::AVAILABLE_DIRECTION) ? $k + 1 : 0)];
        }
    }
}
<?php declare(strict_types = 1);

namespace MarsTest;

use Mars\ControlPanel;
use PHPUnit\Framework\TestCase;

class MarsTest extends TestCase
{
    public function testCommand()
    {
        $input = "5 5\n1 2 N\nLMLMLMLMM\n3 3 E\nMMRMMRMRRM";
        $controlPanel = new ControlPanel($input);

        ob_start();
        $controlPanel->run();
        $content = trim(ob_get_contents());
        ob_end_clean();

        self::assertEquals("1 3 N\n5 1 E", $content);
    }

}
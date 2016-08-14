<?php namespace ParaTest\Runners\PHPUnit;

class RunnerTest extends \TestBase
{
    protected $runner;
    protected $files;
    protected $testDir;

    public function setUp()
    {
        $this->runner = new Runner();
    }

    public function testConstructor()
    {
        $opts = array('processes' => 4, 'path' => FIXTURES . DS . 'tests', 'bootstrap' => 'hello', 'functional' => true);
        $runner = new Runner($opts);
        $options = $this->getObjectValue($runner, 'options');

        $this->assertEquals(4, $options->processes);
        $this->assertEquals(FIXTURES . DS . 'tests', $options->path);
        $this->assertEquals(array(), $this->getObjectValue($runner, 'pending'));
        $this->assertEquals(array(), $this->getObjectValue($runner, 'running'));
        $this->assertEquals(-1, $this->getObjectValue($runner, 'exitcode'));
        $this->assertTrue($options->functional);
        //filter out processes and path and phpunit
        $config = new Configuration(getcwd() . DS . 'phpunit.xml.dist');
        $this->assertEquals(array('bootstrap' => 'hello', 'configuration' => $config), $options->filtered);
        $this->assertInstanceOf('ParaTest\\Logging\\LogInterpreter', $this->getObjectValue($runner, 'interpreter'));
        $this->assertInstanceOf('ParaTest\\Runners\\PHPUnit\\ResultPrinter', $this->getObjectValue($runner, 'printer'));
    }

    public function testGetExitCode()
    {
        $this->assertEquals(-1, $this->runner->getExitCode());
    }
}
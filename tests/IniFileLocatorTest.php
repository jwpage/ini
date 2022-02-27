<?php


class IniFileLocatorTest extends \PHPUnit\Framework\TestCase
{

    public function test_i_returnsIniFileLocatorInstance()
    {
        $instance = \Retrinko\Ini\IniFileLocator::i();
        $this->assertTrue($instance instanceof \Retrinko\Ini\IniFileLocator);
    }

    /**
     * @depends test_i_returnsIniFileLocatorInstance
     * @throws \Retrinko\Ini\Exceptions\FileException
     */
    public function test_locate_returnsSameFileIfNoExistLocalFile()
    {
        $file = __DIR__.'/data/simple.ini';
        $path = \Retrinko\Ini\IniFileLocator::i()->i()->locate($file);
        $this->assertEquals(realpath($file), realpath($path));
    }


    /**
     * @depends test_i_returnsIniFileLocatorInstance
     * @throws \Retrinko\Ini\Exceptions\FileException
     */
    public function test_locate_unexistingFile_throwsException()
    {
        $this->expectException(\Retrinko\Ini\Exceptions\FileException::class);
        $file = __DIR__.'/data/nofile.ini';
        \Retrinko\Ini\IniFileLocator::i()->i()->locate($file);
    }

    public function test_cannot_clone()
    {
        $this->expectException(\BadMethodCallException::class);
        clone(\Retrinko\Ini\IniParser::i());
    }
    
    public function test_cannot_unbserialize()
    {
        $this->expectException(\BadMethodCallException::class);
        unserialize(serialize(\Retrinko\Ini\IniParser::i()));
    }
}
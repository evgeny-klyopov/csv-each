<?php
/**
 * User: ス
 * Date: 24.12.2018
 * Time: 0:53.
 */
use Alva\CsvEach\Iterate;
use PHPUnit\Framework\TestCase;

class IterateTest extends TestCase
{
    private $path;
    private $columns = 3;
    private $rows = 21;

    protected function setUp()
    {
        $this->path = __DIR__.'/data/example.csv';
    }

    public function testIterateText()
    {
        $rows = 0;

        try {
            foreach ((new Iterate($this->path))->each(Iterate::TYPE_TEXT) as $lineNumber => $line) {
                $rows++;
            }
        } catch (Exception $e) {
            $rows = 0;
        }

        $this->assertEquals($this->rows, $rows);
    }

    /**
     * @throws Exception
     */
    public function testIterateArray()
    {
        $this->iterateArray((new Iterate($this->path))->each(Iterate::TYPE_ARRAY));
    }

    public function testIterateArrayBinary()
    {
        $this->path = __DIR__.'/data/example-bytes.csv';
        $rows = 0;
        $size = 0;
        $bytes = 5;

        try {
            foreach ((new Iterate($this->path))->each(Iterate::TYPE_BINARY, $bytes) as $lineNumber => $line) {
                $rows++;
                $size += \mb_strlen($line, '8bit');
            }
        } catch (Exception $e) {
            $rows = 0;
            $size = 0;
        }

        $this->assertEquals(\filesize($this->path), $size);
        $this->assertEquals($this->rows, $rows);
    }

    /**
     * @throws Exception
     */
    public function testIterateChangeDelimiter()
    {
        $this->path = __DIR__.'/data/example-delimiter.csv';

        $this->iterateArray((new Iterate($this->path))->setDelimiter(';')->each(Iterate::TYPE_ARRAY));
    }

    private function iterateArray(\NoRewindIterator $each)
    {
        $rows = 0;
        $columns = 0;

        try {
            foreach ($each as $lineNumber => $line) {
                $columns += \count($line);
                $rows++;
            }
            $columns /= $rows;
        } catch (Exception $e) {
            $rows = 0;
            $columns = 0;
        }

        $this->assertEquals($this->rows, $rows);
        $this->assertEquals($this->columns, $columns);
    }
}

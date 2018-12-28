<?php
/**
 * User: ス
 * Date: 20.12.2018
 * Time: 19:13.
 */

namespace Alva\CsvEach;

class Iterate
{
    /**
     * @var \SplFileObject
     */
    protected $file;

    private $delimiter;

    public const TYPE_BINARY = 'Binary';
    public const TYPE_TEXT = 'Text';
    public const TYPE_ARRAY = 'Array';

    /**
     * Iterate constructor.
     *
     * @param string $filename
     * @param string $mode
     *
     * @throws \Exception
     */
    public function __construct(string $filename, string $mode = 'r')
    {
        if (!is_file($filename)) {
            throw new \Exception('File not found');
        }
        $this->file = new \SplFileObject($filename, $mode);
        $this->setDelimiter(',');
    }

    /**
     * @return \Generator|int
     */
    protected function eachText()
    {
        $count = 0;
        while (!$this->file->eof()) {
            yield $this->file->fgets();
            $count++;
        }

        return $count;
    }

    protected function eachArray()
    {
        $count = 0;
        while (!$this->file->eof()) {
            $line = $this->file->fgets();
            yield empty($line) ? [] : explode($this->delimiter, $line);
            $count++;
        }

        return $count;
    }

    /**
     * @param $bytes
     *
     * @return \Generator
     */
    protected function eachBinary($bytes): ?\Generator
    {
        while (!$this->file->eof()) {
            yield $this->file->fread($bytes);
        }
    }

    /**
     * @param string $type
     * @param null   $bytes
     *
     * @return \NoRewindIterator
     */
    public function each(string $type = self::TYPE_TEXT, $bytes = null): \NoRewindIterator
    {
        $object = null;
        switch ($type) {
            case self::TYPE_BINARY:
                $object = new \NoRewindIterator($this->eachBinary($bytes));
                break;
            case self::TYPE_ARRAY:
                $object = new \NoRewindIterator($this->eachArray());
                break;
            case self::TYPE_TEXT:
            default:
                $object = new \NoRewindIterator($this->eachText());
                break;
        }

        return $object;
    }

    /**
     * @param string $delimiter
     *
     * @return Iterate
     */
    public function setDelimiter(string $delimiter): self
    {
        $this->delimiter = $delimiter;

        return $this;
    }
}

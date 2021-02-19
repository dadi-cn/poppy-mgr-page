<?php

declare(strict_types = 1);

namespace Poppy\CanalEs\Classes;

class Import
{
    /**
     * @var Db
     */
    protected $dao;

    /**
     * @var string $table
     */
    protected $table;

    /**
     * @var int $chunk
     */
    protected $chunk;

    /**
     * @var int $start
     */
    protected $start;

    /**
     * @var int $end
     */
    protected $end;

    /**
     * Import constructor.
     * @throws \Throwable
     */
    public function __construct()
    {
        $this->dao = (new Db())();

    }

    /**
     * @param string $table
     * @return Import
     */
    public function setTable(string $table): Import
    {
        $this->table = $table;

        return $this;
    }

    /**
     * @param int $start
     * @return Import
     */
    public function setStart(int $start): self
    {
        $this->start = $start;
        return $this;
    }

    /**
     * @param int $end
     * @return Import
     */
    public function setEnd(int $end): self
    {
        $this->end = $end;

        return $this;
    }

    /**
     * @param          $size
     * @param callable $callback
     * @return bool
     */
    public function chunk($size, callable $callback): bool
    {
        $page = 1;

        while (true) {
            $statement   = $this->dao->query($this->prepareSql($page, $size));
            $result      = $statement->fetchAll();
            $resultCount = count($result);
            if (!$resultCount) {
                break;
            }

            if (!$callback($result)) {
                return false;
            }

            ++$page;
            if ($resultCount !== $size) {
                break;
            }
        }

        return true;
    }

    /**
     * @param        $page
     * @param        $size
     * @return string
     */
    protected function prepareSql($page, $size): string
    {
        $offset = ($page - 1) * $size;
        return "select * from {$this->table} {$this->range()} limit $offset, $size";
    }

    /**
     * @return string
     */
    protected function range(): string
    {
        $range = [];
        if ($this->start) {
            $range [] = 'id >= ' . $this->start;
        }

        if ($this->end) {
            $range[] = 'id <= ' . $this->end;
        }

        if (!$range) {
            return '';
        }

        return ' where ' . implode(' and ', $range);
    }

}
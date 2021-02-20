<?php

declare(strict_types = 1);

namespace Poppy\CanalEs\Classes;

use Illuminate\Support\Str;
use Poppy\Framework\Classes\Traits\AppTrait;
use Throwable;

class Import
{
    use AppTrait;

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
     * Property Class
     * @var string
     */
    private $property;

    /**
     * Exec Sql
     * @var string
     */
    private $sql;

    /**
     * Import constructor.
     * @throws Throwable
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

    public function setProperty($property)
    {
        $this->property = $property;
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
     * @param               $size
     * @param callable      $callback
     * @param callable|null $output
     * @return bool
     */
    public function chunk($size, callable $callback, callable $output = null): bool
    {
        $page = 1;

        while (true) {
            if (Str::contains($this->table, '.')) {
                $db          = Str::before($this->table, '.');
                $dbStatement = $this->dao->query('show databases');
                $dbs         = collect($dbStatement->fetchAll())->pluck('Database');
                if (!in_array($db, $dbs->toArray())) {
                    return $this->setError('Db `' . $db . '` Not Exists!');
                }
            }

            try {
                $sql       = $this->prepareSql($page, $size);
                $this->sql = $sql;
                if ($output) {
                    $output('Exec Sql :' . $this->sql);
                }
                $statement = $this->dao->query($this->sql);
                $result    = $statement->fetchAll();
            } catch (Throwable $e) {
                return $this->setError("Sql May Has Error : {$e->getMessage()}");
            }

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
        if ($this->property) {
            $className = $this->property;
            $arrFields = array_keys((new $className())->properties());
            $strFields = '`' . implode('`,`', $arrFields) . '`';
        }
        else {
            $strFields = '*';
        }
        return "select {$strFields} from {$this->table} {$this->range()} limit $offset, $size";
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
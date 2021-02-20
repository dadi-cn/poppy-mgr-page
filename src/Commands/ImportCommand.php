<?php

declare(strict_types = 1);

namespace Poppy\CanalEs\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Poppy\CanalEs\Classes\Es\Document;
use Poppy\CanalEs\Classes\Formatter\Format;
use Poppy\CanalEs\Classes\Import;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Throwable;

class ImportCommand extends Command
{
    protected $name = 'ce:import';

    public function handle()
    {
        $table = $this->argument('table');
        $index = $this->option('index');
        if (!$table) {
            $this->error('Not enough arguments (missing: "table")');
            return;
        }

        $index = $index ?: $table;
        $size  = (int) ($this->option('size') ?: 10000);
        $start = (int) ($this->option('start') ?: 0);
        $end   = (int) $this->option('end');

        $formatter = (string) $this->option('formatter');
        $property  = (string) $this->option('property');
        $verbose   = (bool) $this->option('verbose');
        try {
            $import = new Import();
            $import->setTable($table);
            $import->setStart($start)->setEnd($end);
            if ($property) {
                $import->setProperty($property);
            }

            if ($formatter) {
                $formatter = new Format($formatter);
            }

            $output = null;
            if ($verbose) {
                $output = function ($output) {
                    $this->info($output);
                };
            }

            $result = $import->chunk($size, function ($result) use ($index, $formatter) {
                $last = Arr::last($result);
                $this->info('Imported success! last id: ' . ($last['id'] ?? 'not found'));
                $document = (new Document($index));

                if ($formatter instanceof Format) {
                    $document->setFormat($formatter);
                }
                $document->import($result);
                return true;
            }, $output);
            if (!$result) {
                $this->error($import->getError());
                return;
            }
        } catch (Throwable $e) {
            $this->error($e->getMessage());
            return;
        }

        $this->info('All [' . $table . '] records have been imported.');
    }

    /**
     * @return array|array[]
     */
    protected function getArguments(): array
    {
        return [
            ['table', InputArgument::REQUIRED, 'the table need to import'],
        ];
    }

    protected function getOptions()
    {
        return [
            ['size', '', InputOption::VALUE_OPTIONAL, 'The number of records to import at a time'],
            ['index', '', InputOption::VALUE_OPTIONAL, 'The index name records to imported'],
            ['start', '', InputOption::VALUE_OPTIONAL, 'The start record\'s to import sort direction'],
            ['end', '', InputOption::VALUE_OPTIONAL, 'The end record\'s to import sort direction'],
            ['formatter', 'f', InputOption::VALUE_OPTIONAL, 'The class of record need to format'],
            ['property', 'p', InputOption::VALUE_OPTIONAL, 'The property of record need to select from database'],
        ];
    }
}
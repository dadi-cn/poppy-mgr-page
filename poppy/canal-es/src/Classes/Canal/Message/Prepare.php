<?php

declare(strict_types = 1);

namespace Poppy\CanalEs\Classes\Canal\Message;


use Poppy\CanalEs\Classes\Canal\Formatter\Formatter;

class Prepare
{
    /**
     * @var Message
     */
    private $messages;

    /**
     * Prepare constructor.
     * @param Message $message
     */
    public function __construct(Message $message)
    {
        $this->messages = $message;
    }

    /**
     * @return array
     */
    public function records()
    {
        return array_merge($this->prepareDeleted(),
            $this->prepareUpdated(),
            $this->prepareInserted());
    }

    protected function prepareDeleted()
    {
        $records = $this->messages->getDeleted();


        $data = [];
        foreach ($records as $tableName => $tableRecords) {
            $indexName = $this->getIndexByTableName($tableName);
            if (!$indexName) {
                continue;
            }
            foreach ($tableRecords as $record) {
                $data[] = [
                    'delete' => [
                        '_index' => $indexName,
                        '_id'    => $record,
                    ],
                ];
            }
        }

        return $data;
    }

    /**
     * @return array
     */
    protected function prepareUpdated()
    {
        $records = $this->messages->getUpdated();

        $data = [];
        foreach ($records as $tableName => $tableRecords) {
            $indexName = $this->getIndexByTableName($tableName);
            if (!$indexName) {
                continue;
            }
            $formatter = $this->getFormatterByTableName($tableName);
            foreach ($tableRecords as $id => $record) {
                $data[] = [
                    'update' => [
                        '_index' => $indexName,
                        '_id'    => $id,
                    ],
                ];

                $data[] = [
                    'doc' => $formatter instanceof Formatter ? $formatter->setValues($record)->format() : $record,
                ];
            }
        }

        return $data;
    }

    protected function prepareInserted()
    {
        $records = $this->messages->getInserted();

        $data = [];
        foreach ($records as $tableName => $tableRecords) {
            $indexName = $this->getIndexByTableName($tableName);
            if (!$indexName) {
                continue;
            }
            $formatter = $this->getFormatterByTableName($tableName);
            foreach ($tableRecords as $id => $record) {
                $data[] = [
                    'create' => [
                        '_index' => $indexName,
                        '_id'    => $id,
                    ],
                ];

                $data[] = $formatter instanceof Formatter ? $formatter->setValues($record)->format() : $record;
            }
        }

        return $data;
    }

    protected function getIndexByTableName(string $tableName)
    {
        $indexes = config('canal.mapper.index');

        return $indexes[$tableName] ?? '';
    }

    /**
     * @param string $tableName
     * @return Formatter|null
     */
    protected function getFormatterByTableName(string $tableName): ?Formatter
    {
        $formatters = config('canal.mapper.formatter');

        $formatterClass = $formatters[$tableName] ?? '';
        if (!$formatterClass || !class_exists($formatterClass)) {
            return null;
        }

        return new $formatterClass;
    }

}
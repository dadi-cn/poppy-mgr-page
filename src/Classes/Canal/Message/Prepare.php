<?php

declare(strict_types=1);

namespace Poppy\CanalEs\Classes\Canal\Message;

use Poppy\CanalEs\Classes\Es\DocumentFormatter;
use Poppy\CanalEs\Classes\IndexManager;

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
        return array_merge(
            $this->prepareDeleted(),
            $this->prepareUpdated(),
            $this->prepareInserted()
        );
    }

    protected function prepareDeleted()
    {
        $records = $this->messages->getDeleted();


        $data = [];
        foreach ($records as $tableName => $tableRecords) {
            $indexName = IndexManager::indexFormTable($tableName);
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
            $indexName = IndexManager::indexFormTable($tableName);
            if (!$indexName) {
                continue;
            }
            $formatter = IndexManager::formatterFormTable($tableName);
            foreach ($tableRecords as $id => $record) {
                $data[] = [
                    'update' => [
                        '_index' => $indexName,
                        '_id'    => $id,
                    ],
                ];
                $record = $this->propertyFields($tableName, $record);
                $data[] = [
                    'doc'           => $formatter instanceof DocumentFormatter ? $formatter->setValues($record)->format() : $record,
                    'doc_as_upsert' => true,
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
            $indexName = IndexManager::indexFormTable($tableName);
            if (!$indexName) {
                continue;
            }
            $formatter = IndexManager::formatterFormTable($tableName);
            foreach ($tableRecords as $id => $record) {
                $data[] = [
                    'create' => [
                        '_index' => $indexName,
                        '_id'    => $id,
                    ],
                ];
                $record = $this->propertyFields($tableName, $record);
                $data[] = $formatter instanceof DocumentFormatter ? $formatter->setValues($record)->format() : $record;
            }
        }

        return $data;
    }

    /**
     * 保留指定字段
     * @param $tableName
     * @param $data
     * @return array
     */
    private function propertyFields(string $tableName, array $data)
    {
        $property = IndexManager::propertyFormTable($tableName);
        if (!$property) {
            return $data;
        }
        $fields = array_keys($property->properties());
        $result = [];
        foreach ($fields as $field) {
            $result[$field] = $data[$field];
        }
        return $result;
    }
}
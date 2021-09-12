<?php

declare(strict_types = 1);

namespace Poppy\CanalEs\Classes\Canal\Message;

use Com\Alibaba\Otter\Canal\Protocol\Entry;
use Com\Alibaba\Otter\Canal\Protocol\EntryType;
use Com\Alibaba\Otter\Canal\Protocol\EventType;
use Com\Alibaba\Otter\Canal\Protocol\RowChange;
use Com\Alibaba\Otter\Canal\Protocol\RowData;
use Poppy\CanalEs\Classes\Canal\Formatter\DeleteFormatter;
use Poppy\CanalEs\Classes\Canal\Formatter\Formatter;
use Poppy\CanalEs\Classes\Canal\Formatter\InsertFormatter;
use Poppy\CanalEs\Classes\Canal\Formatter\UpdateFormatter;

class Message
{
    /**
     * @var array|Entry[]
     */
    private $entries;

    /**
     * @var string
     */
    private $tableName;

    /**
     * @var array
     */
    private static $eventTypes = [
        EventType::DELETE,
        EventType::INSERT,
        EventType::UPDATE,
    ];

    /**
     * @var Formatter[] $formatters
     */
    private static $formatters;

    /**
     * Message constructor.
     * @param array|Entry[] $entries
     */
    public function __construct(array $entries)
    {
        $this->entries = $entries;
        $this->initFormatters();
    }

    /**
     * @return $this;
     * @throws \Exception
     */
    public function format(): self
    {
        foreach ($this->entries as $entry) {
            $entryType = $entry->getEntryType();
            if (in_array($entryType, [EntryType::TRANSACTIONBEGIN, EntryType::TRANSACTIONEND], false)) {
                continue;
            }

            $database        = $entry->getHeader()->getSchemaName();
            $this->tableName = $database . '.' . $entry->getHeader()->getTableName();

            $this->formatRows($entry);
        }

        return $this;
    }

    /**
     * @return array
     */
    public function getDeleted(): array
    {
        return self::$formatters[EventType::DELETE]->getValues();
    }

    /**
     * @return array
     */
    public function getInserted(): array
    {
        return self::$formatters[EventType::INSERT]->getValues();
    }

    /**
     * @return array
     */
    public function getUpdated(): array
    {
        return self::$formatters[EventType::UPDATE]->getValues();
    }

    /**
     * @param Entry $entry
     * @throws \Exception
     */
    protected function formatRows(Entry $entry)
    {
        $rowChange = new RowChange();
        $rowChange->mergeFromString($entry->getStoreValue());

        $eventType = $rowChange->getEventType();
        /** @var RowData $rowData */
        foreach ($rowChange->getRowDatas() as $rowData) {
            if (!in_array($eventType, self::$eventTypes, false)) {
                continue;
            }
            $formatter = self::$formatters[$eventType];
            $formatter->setTableName($this->tableName);

            switch ($eventType) {
                default:
                case EventType::DELETE:
                    $columns = $rowData->getBeforeColumns();
                    break;
                case EventType::UPDATE:
                case EventType::INSERT:
                    $columns = $rowData->getAfterColumns();
                    break;
            }

            $formatter->addColumns($columns)->format();
        }
    }

    private function initFormatters()
    {
        foreach (self::$eventTypes as $eventType) {
            switch ($eventType) {
                default:
                case EventType::DELETE:
                    $formatter = new DeleteFormatter();
                    break;
                case EventType::UPDATE:
                    $formatter = new UpdateFormatter();
                    break;
                case EventType::INSERT:
                    $formatter = new InsertFormatter();
                    break;
            }

            self::$formatters[$eventType] = $formatter;
        }
    }
}
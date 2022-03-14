<?php

namespace Poppy\MgrApp\Classes\Grid\Exporters;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use function collect;
use function response;

class CsvExporter extends AbstractExporter
{
    /**
     * @inheritDoc
     */
    public function export()
    {
        $filename = $this->getTable() . '.csv';

        return response()->stream(function () {
            $handle = fopen('php://output', 'w');

            $titles = [];

            $this->chunk(function ($records) use ($handle, &$titles) {
                if (empty($titles)) {
                    $titles = $this->getHeaderRowFromRecords($records);

                    // Add CSV headers
                    fputcsv($handle, $titles);
                }

                foreach ($records as $record) {
                    fputcsv($handle, $this->getFormattedRecord($record));
                }
            });

            // Close the output stream
            fclose($handle);
        }, 200, [
            'Content-Encoding'    => 'UTF-8',
            'Content-Type'        => 'text/csv;charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ])->send();
    }

    /**
     * 获取 Header, 从记录中获取 Header
     * @param Collection $records
     * @return array
     */
    public function getHeaderRowFromRecords(Collection $records): array
    {
        $titles = collect(Arr::dot($records->first()->toArray()))->keys()->map(
            function ($key) {
                $key = str_replace('.', ' ', $key);
                return Str::ucfirst($key);
            }
        );

        return $titles->toArray();
    }

    /**
     * 获得格式化的数据
     * @param Model $record
     * @return array
     */
    public function getFormattedRecord(Model $record): array
    {
        return Arr::dot($record->getAttributes());
    }
}

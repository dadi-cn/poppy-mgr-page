<?php

namespace Poppy\MgrApp\Widgets;

use Illuminate\Support\Arr;
use Poppy\Framework\Classes\Resp;

abstract class TableWidget
{
    /**
     * @var array
     */
    private array $headers = [];

    /**
     * @var array
     */
    private array $rows = [];


    /**
     * Table constructor.
     *
     * @param array $headers
     * @param array $rows
     */
    public function __construct(array $headers = [], array $rows = [])
    {
        $this->setHeaders($headers);
        $this->setRows($rows);
    }

    /**
     * Set table headers.
     *
     * @param array $headers
     *
     * @return $this
     */
    public function setHeaders(array $headers = []): self
    {
        $this->headers = $headers;
        return $this;
    }

    /**
     * Set table rows.
     *
     * @param array $rows
     *
     * @return $this
     */
    public function setRows(array $rows = []): self
    {
        if (Arr::isAssoc($rows)) {
            foreach ($rows as $key => $item) {
                $this->rows[] = [$key, $item];
            }

            return $this;
        }
        $this->rows = $rows;
        return $this;
    }

    /**
     * Render the table.
     * @throws \Throwable
     */
    public function render()
    {
        return Resp::success('获取数据成功', [
            'type'    => 'table',
            'headers' => $this->headers,
            'rows'    => $this->rows,
        ]);
    }
}

<?php

declare(strict_types = 1);

namespace Poppy\CanalEs\Classes\Es;

class DocumentFormat
{
    /**
     * @var DocumentFormatter|string $formatter
     */
    private $formatter;

    public function __construct($formatter)
    {
        $this->initFormatter($formatter);
    }

    /**
     * @param $values
     * @return mixed
     */
    public function format($values)
    {
        if (!$this->formatter) {
            return [];
        }
        return $this->formatter->setValues($values)->format();
    }

    private function initFormatter($formatter)
    {
        if ($formatter instanceof DocumentFormatter) {
            $this->formatter = $formatter;
            return;
        }
        $this->formatter = class_exists($formatter) ? new $formatter : null;
    }
}
<?php

namespace Poppy\MgrApp\Classes\Grid\Concerns;

use Poppy\MgrApp\Classes\Grid\Exporter;
use Poppy\MgrApp\Classes\Grid\Exporters\AbstractExporter;

trait HasExport
{

    /**
     * Export driver.
     *
     * @var string
     */
    protected string $exporter = 'csv';


    /**
     * 设置 Grid 的导出方式, 支持 csv, excel , 并可以通过 Extend 进行自定义
     * @param $exporter
     * @return $this
     */
    public function exporter($exporter): self
    {
        $this->exporter = $exporter;
        return $this;
    }

    /**
     * 导出请求
     * @param string $scope
     */
    protected function queryExport(string $scope = 'page')
    {
        // clear output buffer.
        if (ob_get_length()) {
            ob_end_clean();
        }

        $this->model()->usePaginate(false);

        $this->getExporter($scope)->export();
    }

    /**
     * @param string $scope
     * @return AbstractExporter
     */
    protected function getExporter(string $scope): AbstractExporter
    {
        return (new Exporter($this))->resolve($this->exporter)->withScope($scope);
    }
}

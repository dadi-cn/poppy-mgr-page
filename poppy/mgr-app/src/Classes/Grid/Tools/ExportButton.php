<?php

namespace Poppy\MgrApp\Classes\Grid\Tools;

use Poppy\MgrApp\Classes\Widgets\GridWidget;
use function request;
use function trans;
use function view;

class ExportButton extends AbstractTool
{
    /**
     * @var GridWidget
     */
    protected $grid;

    /**
     * Create a new Export button instance.
     *
     * @param GridWidget $grid
     */
    public function __construct(GridWidget $grid)
    {
        $this->grid = $grid;
    }

    /**
     * Render Export button.
     *
     * @return string
     */
    public function render()
    {
        if (!$this->grid->isShowExporter()) {
            return '';
        }

        $page      = request('page', 1);
        $variables = [
            'export'               => trans('admin.export'),
            'all'                  => trans('admin.all'),
            'all_url'              => $this->grid->getExportUrl('all'),
            'current_page_url'     => $this->grid->getExportUrl('page', $page),
            'current_page'         => trans('admin.current_page'),
            'selected_rows'        => trans('admin.selected_rows'),
            'selected_rows_url'    => $this->grid->getExportUrl('selected', '__rows__'),
            'selected_export_name' => $this->grid->getExportSelectedName(),
        ];

        return view('py-system::tpl.filter.export-button', $variables);
    }
}

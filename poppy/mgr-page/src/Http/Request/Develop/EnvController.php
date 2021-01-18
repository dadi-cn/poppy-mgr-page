<?php namespace Poppy\MgrPage\Http\Request\Develop;

use DB;
use Eloquent;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;
use phpDocumentor\Reflection\DocBlock\Tags\Property;
use phpDocumentor\Reflection\DocBlockFactory;
use Poppy\Core\Classes\Traits\CoreTrait;
use Poppy\Framework\Classes\Resp;
use Poppy\System\Models\SysConfig;
use ReflectionClass;
use Throwable;

/**
 * 环境检测工具
 */
class EnvController extends DevelopController
{
    use CoreTrait;

    /**
     * php info
     * @return Factory|View
     */
    public function phpinfo()
    {
        return view('py-mgr-page::develop.env.phpinfo');
    }


    /**
     * 模型注释
     */
    public function model()
    {

        $items = sys_cache('py-system')->remember('controller.env.model', SysConfig::MIN_HALF_DAY, function () {
            $files   = app('files')->glob(base_path('modules/*/src/models/*.php'));
            $modules = [];
            foreach ($files as $file) {
                if (preg_match('/modules\/([a-zA-Z]*)\/src/i', $file, $match)) {
                    $slug = $match[1];
                    if (!isset($modules[$slug])) {
                        $manifest       = app('poppy')->getManifest($slug);
                        $modules[$slug] = [
                            'slug'        => $slug,
                            'tables'      => [],
                            'description' => $manifest['name'],
                        ];
                    }
                    try {
                        $class = poppy_class($slug, 'Models\\' . basename($file, '.php'));
                        $Ref   = new ReflectionClass($class);
                        /** @var Eloquent $Model */
                        $Model = new $class;
                        $table = $Model->getTable();
                    } catch (Throwable $e) {
                        continue;
                    }

                    $comment = $Ref->getDocComment();

                    $factory  = DocBlockFactory::createInstance();
                    $docBlock = $factory->create($comment);

                    /** @var Property $property */
                    $properties = $docBlock->getTagsByName('property');


                    $summary = $docBlock->getSummary();
                    if (!$summary) {
                        return Resp::error('你需要先设定 `' . $class . '` 的表描述');
                    }

                    $fields = [];
                    foreach ($properties as $property) {
                        $fields[] = [
                            'type'        => (string) $property->getType(),
                            'variable'    => $property->getVariableName(),
                            'description' => $property->getDescription()->render(),
                        ];
                    }
                    $modules[$slug]['tables'][] = [
                        'table'       => $table,
                        'description' => $summary,
                        'fields'      => $fields,
                    ];
                }
            }
            return $modules;
        });
        return view('py-mgr-page::develop.env.model', [
            'items' => $items,
        ]);
    }


    /**
     * 检查数据库设计
     * @url http://blog.csdn.net/zhezhebie/article/details/78589812
     */
    public function db()
    {
        $tables = array_map('reset', DB::select('show tables'));

        $suggestString   = function ($col) {
            if (strpos($col['Type'], 'char') !== false) {
                if ($col['Null'] === 'YES') {
                    return '(Char-null)';
                }
                if (!is_null($col['Default']) && $col['Default'] !== '') {
                    if (!is_string($col['Default'])) {
                        return '(Char-default)';
                    }
                }
            }

            return '';
        };
        $suggestInt      = function ($col) {
            if (strpos($col['Type'], 'int') !== false) {
                switch ($col['Key']) {
                    case 'PRI':
                        // 主键不能为Null (Allow Null 不可选)
                        // Default 不可填入值
                        // 所以无任何输出
                        break;
                    default:
                        if (!is_numeric($col['Default'])) {
                            return '(Int-default)';
                        }
                        if ($col['Null'] === 'YES') {
                            return '(Int-Null)';
                        }
                        break;
                }
            }

            return '';
        };
        $suggestDecimal  = function ($col) {
            if (strpos($col['Type'], 'decimal') !== false) {
                if ($col['Default'] !== '0.00') {
                    return '(Decimal-default)';
                }
                if ($col['Null'] === 'YES') {
                    return '(Decimal-Null)';
                }
            }

            return '';
        };
        $suggestDatetime = function ($col) {
            if (strpos($col['Type'], 'datetime') !== false) {
                if (!is_null($col['Default'])) {
                    return '(Datetime-default)';
                }
                if ($col['Null'] === 'NO') {
                    return '(Datetime-null)';
                }
            }

            return '';
        };
        $suggestFloat    = function ($col) {
            if (strpos($col['Type'], 'float') !== false) {
                return '(Float-set)';
            }

            return '';
        };

        $formatTables = [];
        foreach ($tables as $table) {
            $columns       = DB::select('show full columns from ' . $table);
            $formatColumns = [];
            /*
             * column 字段
             * Field      : account_no
             * Type       : varchar(100)
             * Collation  : utf8_general_ci
             * Null       : NO
             * Key        : ""
             * Default    : ""
             * Extra      : ""
             * Privileges : select,insert,update,references
             * Comment    : 账号
             * ---------------------------------------- */

            foreach ($columns as $column) {
                $column            = (array) $column;
                $column['suggest'] =
                    $suggestString($column) .
                    $suggestInt($column) .
                    $suggestDecimal($column) .
                    $suggestDatetime($column);
                $suggestFloat($column);
                $formatColumns[$column['Field']] = $column;
            }
            $formatTables[$table] = $formatColumns;
        }

        return view('py-mgr-page::develop.env.db', [
            'items' => $formatTables,
        ]);
    }
}
<?php namespace Op\Http\Request\ApiV1\Web;

use Illuminate\Support\Str;
use Op\Action\OpToolAction;
use Poppy\Framework\Classes\Resp;
use Poppy\Framework\Helper\StrHelper;
use Poppy\Framework\Helper\UtilHelper;
use Poppy\System\Http\Request\ApiV1\Web\WebApiController;

/**
 * 工具
 */
class ToolController extends WebApiController
{

    public function apidoc()
    {
        $content = input('content');
        if (!UtilHelper::isJson($content)) {
            return Resp::error('非法Json');
        }

        $arrContent = json_decode($content, false);
        $keys       = $this->parseApidoc($arrContent);

        $arrContent = [];
        $keyLength  = 0;
        foreach ($keys as $_key => $type) {
            if (Str::contains($_key, '.0.')) {
                continue;
            }
            $keyLength         = strlen($_key) > $keyLength ? strlen($_key) : $keyLength;
            $spaceStr          = str_repeat(' ', 9 - strlen($type));
            $arrContent[$_key] = " * @apiSuccess {{$type}}{$spaceStr}{$_key}[-|ntabs|-] |";
        }

        $strContent = '';
        foreach ($arrContent as $_key => $_line) {
            $leftLen    = $keyLength - strlen($_key) + 1;
            $strContent .= str_replace('[-|ntabs|-]', str_repeat(' ', $leftLen), $_line) . PHP_EOL;
        }

        $Tool   = new OpToolAction();
        $result = $Tool->apidocJsonComment($content);
        if ($result) {
            $strContent .= PHP_EOL . ' * @apiSuccessExample {json} data:' . PHP_EOL . $result;
        }

        $prefix = '/' . '*' . '*
 * @api {post}       /  
 * @apiDescription   |
 * @apiName          |
 * @apiGroup         |
 *
 * @apiParam {int}   |
 * ' . PHP_EOL;
        return Resp::success('处理成功', [
            'comment' => $prefix . $strContent . PHP_EOL . ' */',
        ]);
    }


    /**
     * 实体转换
     * @return mixed
     */
    public function htmlEntity()
    {
        if (is_post()) {
            $content = input('content');

            return Resp::web(Resp::SUCCESS, '转化成功', [
                'content'        => htmlentities($content),
                'content_origin' => $content,
            ]);
        }

        return view('site::web.tool.html_entity');
    }

    /**
     * 实体转换
     * @return mixed
     */
    public function sslKey()
    {
        if (is_post()) {
            $content = input('content');
            if (Str::startsWith($content, '-----')) {
                // remove top/bottom and inline
                $convert = preg_replace('/-----.*?-----/', '', $content);
                $convert = StrHelper::trimSpace($convert);
            }
            else if (!$content) {
                $convert = '';
            }
            else {
                $splits = str_split($content, 64);
                $type   = input('type');
                $start  = '-----BEGIN ' . strtoupper($type) . ' KEY-----';
                $end    = '-----END ' . strtoupper($type) . ' KEY-----';
                array_unshift($splits, $start);
                $splits[] = $end;
                $convert  = implode(PHP_EOL, $splits);
            }
            return Resp::web(Resp::SUCCESS, '转化成功', [
                'content'        => $convert,
                'content_origin' => $content,
            ]);
        }

        return view('site::web.tool.ssl_key');
    }


    public function formatApiDoc()
    {
        $Tool = new OpToolAction();
        if (!$result = $Tool->apidocJsonComment(input('content'))) {
            return Resp::error($Tool->getError());
        }
        return Resp::success('转换成功', [
            'result' => $result,
        ]);
    }


    private function parseApidoc($content, &$keys = [], $current_key = ''): array
    {
        foreach ($content as $_key => $_content) {
            $key = $current_key ? $current_key . '.' . $_key : $_key;
            if (is_int($_content)) {
                $keys[$key] = 'int';
            }
            if (is_string($_content)) {
                $keys[$key] = 'string';
            }
            if (is_bool($_content)) {
                $keys[$key] = 'boolean';
            }
            if (is_array($_content) || is_object($_content)) {
                $keys[$key] = is_object($_content)
                    ? 'object'
                    : 'array';
                $appendKeys = $this->parseApidoc($_content, $keys, $key);
                $keys       = array_merge($keys, $appendKeys);
            }
        }
        $str_replace = [];
        foreach ($keys as $_key => $_content) {
            // object 解析
            if (isset($keys["{$_key}.0"])) {
                $str_replace[] = $_key . '.0';
                unset($keys[$_key]);
            }
            elseif (strpos($_key, '.0') !== false) {
                continue;
            }
            // 去除多层嵌套的
            elseif (preg_match('/\.\d+\.?/u', $_key)) {
                unset($keys[$_key]);
            }
            // 去除 key 是数值
            elseif (preg_match('/^\d+$/u', $_key)) {
                unset($keys[$_key]);
            }
            // 去除以数值开始
            elseif (preg_match('/^\d+\./u', $_key)) {
                unset($keys[$_key]);
            }
        }
        foreach ($keys as $_key => $_content) {
            foreach ($str_replace as $_replace) {
                if ($_key === $_replace) {
                    unset($keys[$_key]);
                    $keys[str_replace('.0', '', $_key)] = 'object[]';
                }
                elseif (Str::startsWith($_key, $_replace)) {
                    unset($keys[$_key]);
                    $keys[str_replace('.0', '', $_key)] = $_content;
                }
            }
        }

        return $keys;
    }

}
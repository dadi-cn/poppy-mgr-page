<?php namespace Op\Action;

use Poppy\Framework\Classes\Traits\AppTrait;
use Poppy\Framework\Helper\UtilHelper;

/**
 * Op Tool
 */
class OpToolAction
{

    use AppTrait;

    /**
     * 格式化 ApiDocJson
     * @param string $json_result Json 字串
     * @return string|bool
     */
    public function apidocJsonComment(string $json_result)
    {
        if (!$json_result) {
            return $this->setError('输入内容为空');
        }
        if (!UtilHelper::isJson($json_result)) {
            return $this->setError('给定的数据不是正确的JSON 格式');
        }

        $arrResult = json_decode($json_result, true);
        $formatRes = $this->firstElement($arrResult);
        $json  = json_encode($formatRes, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        $lines = explode(PHP_EOL, $json);
        $res   = '';
        foreach ($lines as $line) {
            $res .= ' * ' . $line . PHP_EOL;
        }

        $res = rtrim($res, PHP_EOL);
        return $res;
    }

    private function firstElement($result)
    {
        foreach ($result as $key => $res) {
            if (is_array($res)) {
                $current = current($res);
                if (is_array($current)) {
                    $currentRes = $this->firstElement($current);
                }
                else {
                    $currentRes = $current;
                }
                $result[$key] = [$currentRes];
            }
        }
        return $result;
    }
}
<?php namespace Poppy\AliyunOss\Action;

use Exception;
use OSS\OssClient;
use Poppy\System\Classes\Uploader\DefaultUploadProvider;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * 图片上传
 */
class OssDefaultUploadProvider extends DefaultUploadProvider
{
    /**
     * @var bool 是否在保存后删除本地文件
     */
    private $deleteLocal = true;

    /**
     * 保存文件输入
     * @param UploadedFile $file 文件
     * @return bool|mixed
     */
    public function saveFile($file)
    {
        if (!parent::saveFile($file)) {
            return false;
        }
        return $this->saveAli($this->deleteLocal);
    }

    /**
     * 保存流输入
     * @param string $content 文件内容
     * @return bool
     */
    public function saveInput($content): bool
    {
        if (!parent::saveInput($content)) {
            return false;
        }

        return $this->saveAli($this->deleteLocal);
    }

    /**
     * 保存到阿里云
     * @param bool $delete_local 是否删除本地文件
     * @return bool
     */
    private function saveAli($delete_local = true)
    {
        // 设置返回地址
        $returnUrl = config('poppy.aliyun-oss.url');
        $this->setReturnUrl($returnUrl);

        if (!$returnUrl) {
            return $this->setError(trans('py-system::action.oss_uploader.return_url_error'));
        }

        $endpoint = config('poppy.aliyun-oss.endpoint');
        $bucket   = config('poppy.aliyun-oss.bucket');


        $accessKeyId     = config('poppy.aliyun-oss.access_key');
        $accessKeySecret = config('poppy.aliyun-oss.access_secret');


        try {
            $ossClient = new OssClient($accessKeyId, $accessKeySecret, $endpoint, false);
            $ossClient->putObject($bucket, $this->destination, $this->storage()->get($this->destination));
            if ($delete_local) {
                $this->storage()->delete($this->destination);
            }
            return true;
        } catch (Exception $e) {
            return $this->setError($e->getMessage());
        }
    }
}
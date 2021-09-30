<?php namespace Op\Http\Request\Web;

use Illuminate\Http\Response;
use Op\Classes\ImageGenerator\PlainGenerator;
use Poppy\Framework\Application\Controller;
use Poppy\Framework\Classes\Traits\ViewTrait;

/**
 * 占位符
 */
class ImagePhController extends Controller
{
    use ViewTrait;

    /**
     * @param int    $spec
     * @param string $text
     * @return Response
     */
    public function generate($spec = 50, $text = '')
    {
        $width = $height = 0;
        if (is_numeric($spec)) {
            $width = $height = $spec;
        }
        if (strpos($spec, 'x') !== false) {
            [$width, $height] = explode('x', $spec);
            $width  = (int) $width;
            $height = (int) $height;
            if (!$height) {
                $height = $width;
            }
        }

        $bg = '#' . input('_bg', '282828');
        $fc = '#' . input('_fc', 'EAE0D0');
        $img = (new PlainGenerator())->gen($width, $height, $text, $bg, $fc);

        return $img->response('png');
    }
}

<?php namespace Op\Classes\ImageGenerator;

use Intervention\Image\AbstractFont;
use Intervention\Image\Gd\Font;
use Intervention\Image\Image;

/**
 * 生成基本文字
 */
class PlainGenerator extends BaseImageGenerator
{
    /**
     * 生成图片
     * @param int    $width
     * @param int    $height
     * @param string $text
     * @param string $bg
     * @param string $fc
     * @return Image
     */
    public function gen(int $width, int $height, string $text = '', $bg = '#282828', $fc = '#eae0d0'): Image
    {
        $img      = $this->manager->canvas($width, $height, $bg);
        $fontFile = poppy_path('module.op', 'resources/fonts/sarasa-mono-light.ttf');

        // min: 20 /max 50
        $size = (($width / 10) <= 14)
            ? 14
            : (($width / 10) >= 50 ? 50 : round($width / 10));

        // write size
        $sizeFont = new Font();
        $sizeFont->text("{$width}x{$height}");
        $sizeFont->size($size);
        $sizeFont->file($fontFile);
        $box        = $sizeFont->getBoxSize();
        $fontHeight = $box['height'];
        $fontWidth  = $box['width'];
        $y          = ($height - $fontHeight) / 2 + $fontHeight;
        $x          = ($width - $fontWidth) / 2;
        $img->text("{$width}x{$height}", $x, $y, function (AbstractFont $font) use ($fontFile, $size, $fc) {
            $font->align('left');
            $font->color($fc);
            $font->size($size);
            $font->file($fontFile);
        });

        // write desc
        if ($text && $width > 60 && $height > 24) {
            $fontSize = max(12, min(round($size * .85), 22));
            $descFont = new Font();
            $descFont->text($text);
            $descFont->size($fontSize);
            $descFont->file($fontFile);
            $y = $height - 5;
            $img->text($text, 5, $y, function (AbstractFont $font) use ($fontFile, $fontSize, $fc) {
                $font->align('left');
                $font->color($fc);
                $font->size($fontSize);
                $font->file($fontFile);
            });
        }
        return $img;
    }
}

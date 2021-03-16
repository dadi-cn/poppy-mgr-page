<?php

namespace Php\Http\Request\Web;

use Image;
use Poppy\System\Http\Request\Web\WebController;

class InterventionImageController extends WebController
{
    /**
     * @url http://yanue.net/post-57.html
     */
    public function jpg()
    {
        // create a new image resource
        $img = Image::canvas(400, 400, '#336688');

        // send HTTP header and output image data
        return $img->response('jpg', 70);
    }
}
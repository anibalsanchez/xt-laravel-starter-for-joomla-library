<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

namespace Extly\Illuminate\Http\Testing;

use Extly\Illuminate\Support\Str;

class FileFactory
{
    /**
     * Create a new fake file.
     *
     * @param  string  $name
     * @param  string|int  $kilobytes
     * @param  string|null  $mimeType
     * @return \Illuminate\Http\Testing\File
     */
    public function create($name, $kilobytes = 0, $mimeType = null)
    {
        if (is_string($kilobytes)) {
            return $this->createWithContent($name, $kilobytes);
        }

        return XT_tap(new File($name, tmpfile()), function ($file) use ($kilobytes, $mimeType) {
            $file->sizeToReport = $kilobytes * 1024;
            $file->mimeTypeToReport = $mimeType;
        });
    }

    /**
     * Create a new fake file with content.
     *
     * @param  string  $name
     * @param  string  $content
     * @return \Illuminate\Http\Testing\File
     */
    public function createWithContent($name, $content)
    {
        $tmpfile = tmpfile();

        fwrite($tmpfile, $content);

        return XT_tap(new File($name, $tmpfile), function ($file) use ($tmpfile) {
            $file->sizeToReport = fstat($tmpfile)['size'];
        });
    }

    /**
     * Create a new fake image.
     *
     * @param  string  $name
     * @param  int  $width
     * @param  int  $height
     * @return \Illuminate\Http\Testing\File
     */
    public function image($name, $width = 10, $height = 10)
    {
        return new File($name, $this->generateImage(
            $width, $height, Str::endsWith(Str::lower($name), ['.jpg', '.jpeg']) ? 'jpeg' : 'png'
        ));
    }

    /**
     * Generate a dummy image of the given width and height.
     *
     * @param  int  $width
     * @param  int  $height
     * @param  string  $type
     * @return resource
     */
    protected function generateImage($width, $height, $type)
    {
        return XT_tap(tmpfile(), function ($temp) use ($width, $height, $type) {
            ob_start();

            $image = imagecreatetruecolor($width, $height);

            switch ($type) {
                case 'jpeg':
                    imagejpeg($image);
                    break;
                case 'png':
                    imagepng($image);
                    break;
            }

            fwrite($temp, ob_get_clean());
        });
    }
}

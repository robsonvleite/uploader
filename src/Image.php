<?php

namespace CoffeeCode\Uploader;

/**
 * Class CoffeeCode Image
 *
 * @author Robson V. Leite <https://github.com/robsonvleite>
 * @package CoffeeCode\Uploader
 */
class Image extends Uploader
{
    /**
     * Allow jpg, png and gif images, use from check. For new extensions check the imageCrete method
     *
     * @var array allowed media types
     */
    protected static $allowTypes = [
        "image/jpeg",
        "image/png",
        "image/gif",
    ];

    /**
     * @param array $image
     * @param string $name
     * @param int $width
     * @param array $q = ['jpg' => 0-100 quality, 'png' => 0-9 compressor]
     * @return string
     * @throws \Exception
     */
    public function upload(array $image, string $name, int $width = 2000, array $q = ["jpg" => 75, "png" => 5]): string
    {
        if (empty($image['type'])) {
            throw new \Exception("Not a valid data from image");
        }

        if (!$this->imageCreate($image)) {
            throw new \Exception("{$image['type']} - Not a valid file type");
        } else {
            $this->name($name);
        }

        if ($this->ext == "gif" && move_uploaded_file("{$image['tmp_name']}", "{$this->path}/{$this->name}")) {
            return "{$this->path}/{$this->name}";
        }

        $fileX = imagesx($this->file);
        $fileY = imagesy($this->file);
        $imageW = ($width < $fileX ? $width : $fileX);
        $imageH = ($imageW * $fileY) / $fileX;
        $imageCreate = imagecreatetruecolor($imageW, $imageH);

        if ($this->ext == "jpg") {
            imagecopyresampled($imageCreate, $this->file, 0, 0, 0, 0, $imageW, $imageH, $fileX, $fileY);
            imagejpeg($imageCreate, "{$this->path}/{$this->name}", $q['jpg']);
        }

        if ($this->ext == "png") {
            imagealphablending($imageCreate, false);
            imagesavealpha($imageCreate, true);
            imagecopyresampled($imageCreate, $this->file, 0, 0, 0, 0, $imageW, $imageH, $fileX, $fileY);
            imagepng($imageCreate, "{$this->path}/{$this->name}", $q['png']);
        }

        imagedestroy($this->file);
        imagedestroy($imageCreate);

        return "{$this->path}/{$this->name}";
    }

    /**
     * Image create from mime-type
     * https://developer.mozilla.org/en-US/docs/Web/HTTP/Basics_of_HTTP/MIME_types#Image_types
     *
     * @param array $image
     * @return bool
     */
    protected function imageCreate(array $image): bool
    {
        if ($image['type'] == "image/jpeg") {
            $this->file = imagecreatefromjpeg($image['tmp_name']);
            $this->ext = "jpg";
            return true;
        }

        if ($image['type'] == "image/png") {
            $this->file = imagecreatefrompng($image['tmp_name']);
            $this->ext = "png";
            return true;
        }

        if ($image['type'] == "image/gif") {
            $this->file = $image;
            $this->ext = "gif";
            return true;
        }
        return false;
    }
}
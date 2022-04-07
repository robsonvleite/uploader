<?php

namespace CoffeeCode\Uploader;

use Exception;

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
     * @var array allowed media types
     */
    protected static array $allowTypes = [
        "image/jpeg",
        "image/png",
        "image/gif",
    ];

    /**
     * @param array $image
     * @param string $name
     * @param int $width
     * @param array|null $quality
     * @return string
     * @throws Exception
     */
    public function upload(array $image, string $name, int $width = 2000, ?array $quality = null): string
    {
        if (empty($image['type'])) {
            throw new Exception("Not a valid data from image");
        }

        if (!$this->imageCreate($image)) {
            throw new Exception("Not a valid image type or extension");
        }

        $this->name($name);

        if ($this->ext == "gif") {
            move_uploaded_file("{$image['tmp_name']}", "{$this->path}/{$this->name}");
            return "{$this->path}/{$this->name}";
        }

        $this->imageGenerate($width, ($quality ?? ["jpg" => 75, "png" => 5]));
        return "{$this->path}/{$this->name}";
    }

    /**
     * Image create and valid extension from mime-type
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
            $this->ext = "gif";
            return true;
        }

        return false;
    }

    /**
     * @param int $width
     * @param array $quality
     */
    private function imageGenerate(int $width, array $quality): void
    {
        $fileX = intval(imagesx($this->file));
        $fileY = intval(imagesy($this->file));
        $imageW = ($width < $fileX ? $width : $fileX);
        $imageH = intval(($imageW * $fileY) / $fileX);
        $imageCreate = imagecreatetruecolor($imageW, $imageH);

        if ($this->ext == "jpg") {
            imagecopyresampled($imageCreate, $this->file, 0, 0, 0, 0, $imageW, $imageH, $fileX, $fileY);
            imagejpeg($imageCreate, "{$this->path}/{$this->name}", $quality['jpg']);
        }

        if ($this->ext == "png") {
            imagealphablending($imageCreate, false);
            imagesavealpha($imageCreate, true);
            imagecopyresampled($imageCreate, $this->file, 0, 0, 0, 0, $imageW, $imageH, $fileX, $fileY);
            imagepng($imageCreate, "{$this->path}/{$this->name}", $quality['png']);
        }

        imagedestroy($this->file);
        imagedestroy($imageCreate);
    }
}

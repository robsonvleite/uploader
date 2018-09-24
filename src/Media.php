<?php

namespace CoffeeCode\Uploader;

/**
 * Class CoffeeCode Media
 *
 * @author Robson V. Leite <https://github.com/robsonvleite>
 * @package CoffeeCode\Uploader
 */
class Media extends Uploader
{
    /**
     * @var array allowed media types
     */
    protected static $allowTypes = [
        "audio/mp3",
        "video/mp4"
    ];

    /**
     * Send an media from a form
     *
     * @param array $media
     * @param string $name
     * @return null|string
     * @throws \Exception
     */
    public function upload(array $media, string $name): string
    {
        if (!in_array($media['type'], static::$allowTypes)) {
            throw new \Exception("{$media['type']} - Not a valid media type");
        } else {
            $this->ext = mb_strtolower(pathinfo($media['name'])['extension']);
            $this->name($name);
        }

        move_uploaded_file($media['tmp_name'], "{$this->path}/{$this->name}");
        return "{$this->path}/{$this->name}";
    }
}
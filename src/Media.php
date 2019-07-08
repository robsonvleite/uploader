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
     * Allow mp4 video and mp3 audio
     * @var array allowed media types
     * https://www.freeformatter.com/mime-types-list.html
     */
    protected static $allowTypes = [
        "audio/mp3",
        "audio/mpeg",
        "video/mp4",
    ];

    /**
     * Allowed extensions to types.
     * @var array
     */
    protected static $extensions = [
        "mp3",
        "mp4"
    ];

    /**
     * @param array $media
     * @param string $name
     * @return null|string
     * @throws \Exception
     */
    public function upload(array $media, string $name): string
    {
        $this->ext = mb_strtolower(pathinfo($media['name'])['extension']);

        if (!in_array($media['type'], static::$allowTypes) || !in_array($this->ext, static::$extensions)) {
            throw new \Exception("Not a valid media type or extension");
        }

        $this->name($name);
        move_uploaded_file($media['tmp_name'], "{$this->path}/{$this->name}");
        return "{$this->path}/{$this->name}";
    }
}

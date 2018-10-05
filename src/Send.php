<?php

namespace CoffeeCode\Uploader;

/**
 * Class CoffeeCode Send
 *
 * @author Robson V. Leite <https://github.com/robsonvleite>
 * @package CoffeeCode\Uploader
 */
class Send extends Uploader
{
    /**
     * Send constructor.
     *
     * @param string $uploadDir
     * @param string $fileTypeDir
     * @param array $allowTypes
     */
    public function __construct(string $uploadDir, string $fileTypeDir, array $allowTypes)
    {
        parent::__construct($uploadDir, $fileTypeDir);
        self::$allowTypes = $allowTypes;
    }

    /**
     * @param array $file
     * @param string $name
     * @return string
     * @throws \Exception
     */
    public function upload(array $file, string $name): string
    {
        if (!in_array($file['type'], static::$allowTypes)) {
            throw new \Exception("{$file['type']} - Not a valid file type");
        } else {
            $this->ext = mb_strtolower(pathinfo($file['name'])['extension']);
            $this->name($name);
        }

        move_uploaded_file($file['tmp_name'], "{$this->path}/{$this->name}");
        return "{$this->path}/{$this->name}";
    }
}
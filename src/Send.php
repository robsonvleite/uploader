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
     * @param array $extensions
     * https://www.freeformatter.com/mime-types-list.html
     */
    public function __construct(string $uploadDir, string $fileTypeDir, array $allowTypes, array $extensions)
    {
        parent::__construct($uploadDir, $fileTypeDir);
        self::$allowTypes = $allowTypes;
        self::$extensions = $extensions;
    }

    /**
     * @param array $file
     * @param string $name
     * @return string
     * @throws \Exception
     */
    public function upload(array $file, string $name): string
    {
        $this->ext = mb_strtolower(pathinfo($file['name'])['extension']);

        if (!in_array($file['type'], static::$allowTypes) || !in_array($this->ext, static::$extensions)) {
            throw new \Exception("Not a valid file type or extension");
        }

        $this->name($name);
        move_uploaded_file($file['tmp_name'], "{$this->path}/{$this->name}");
        return "{$this->path}/{$this->name}";
    }
}
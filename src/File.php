<?php

namespace CoffeeCode\Uploader;

/**
 * Class CoffeeCode File
 *
 * @author Robson V. Leite <https://github.com/robsonvleite>
 * @package CoffeeCode\Uploader
 */
class File extends Uploader
{
    /**
     * Allow zip, rar, bzip, pdf, doc, docx files
     * @var array allowed file types
     */
    protected static $allowTypes = [
        "application/zip",
        'application/x-rar-compressed',
        'application/x-bzip',
        "application/pdf",
        "application/msword",
        "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
    ];

    /**
     * @param array $file
     * @param string $name
     * @return null|string
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
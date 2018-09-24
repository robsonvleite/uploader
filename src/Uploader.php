<?php

namespace CoffeeCode\Uploader;

/**
 * Class CoffeeCode Uploader
 *
 * @author Robson V. Leite <https://github.com/robsonvleite>
 * @package CoffeeCode\Uploader
 */
abstract class Uploader
{
    /** @var string */
    protected $path;

    /** @var string */
    protected $file;

    /** @var string */
    protected $name;

    /** @var string */
    protected $ext;

    /**
     * Uploader constructor.
     * @param string $uploadDir
     * @param string $fileTypeDir
     * @example $u = new Upload("storage/uploads", "images");
     */
    public function __construct(string $uploadDir, string $fileTypeDir)
    {
        $this->dir($uploadDir);
        $this->dir("{$uploadDir}/{$fileTypeDir}");
        $this->path("{$uploadDir}/{$fileTypeDir}");
    }

    /**
     * Name slug with extension
     *
     * @param string $name
     * @return string
     */
    protected function name(string $name): string
    {
        $name = filter_var(mb_strtolower($name), FILTER_SANITIZE_STRIPPED);
        $formats = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]/?;:.,\\\'<>°ºª';
        $replace = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr                                 ';
        $name = str_replace(["-----", "----", "---", "--"], "-",
            str_replace(" ", "-", trim(strtr(utf8_decode($name), utf8_decode($formats), $replace))));

        $this->name = "{$name}." . $this->ext;

        if (file_exists("{$this->path}/{$this->name}") && is_file("{$this->path}/{$this->name}")) {
            $this->name = "{$name}-" . time() . ".{$this->ext}";
        }
        return $this->name;
    }

    /**
     * Directory scan and create
     *
     * @param string $dir
     * @param int $mode
     */
    protected function dir(string $dir, int $mode = 0755): void
    {
        if (!file_exists($dir) || !is_dir($dir)) {
            mkdir($dir, $mode);
        }
    }

    /**
     * Create path year and month based
     *
     * @param string $path
     */
    protected function path(string $path): void
    {
        list($yearPath, $mothPath) = explode("/", date("Y/m"));

        $this->dir("{$path}/{$yearPath}");
        $this->dir("{$path}/{$yearPath}/{$mothPath}");
        $this->path = "{$path}/{$yearPath}/{$mothPath}";
    }

    /**
     * Remove file if exists
     *
     * @param string $filePath
     */
    public function remove(string $filePath): void
    {
        if (file_exists($filePath) && is_file($filePath)) {
            unlink($filePath);
        }

        if (file_exists("{$this->path}/{$filePath}") && is_file("{$this->path}/{$filePath}")) {
            unlink("{$this->path}/{$filePath}");
        }
    }
}
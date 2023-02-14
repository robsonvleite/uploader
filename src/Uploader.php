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
    protected string $path;

    /** @var resource */
    protected $file;

    /** @var string */
    protected string $name;

    /** @var string */
    protected string $ext;

    /** @var array */
    protected static array $allowTypes = [];

    /** @var array */
    protected static array $extensions = [];

    /**
     * @param string $uploadDir
     * @param string $fileTypeDir
     * @param bool $monthYearPath
     * @example $u = new Upload("storage/uploads", "images");
     */
    public function __construct(string $uploadDir, string $fileTypeDir, bool $monthYearPath = true)
    {
        $this->dir($uploadDir);
        $this->dir("{$uploadDir}/{$fileTypeDir}");
        $this->path = "{$uploadDir}/{$fileTypeDir}";

        if ($monthYearPath) {
            $this->path("{$uploadDir}/{$fileTypeDir}");
        }
    }

    /**
     * @return array
     */
    public static function isAllowed(): array
    {
        return static::$allowTypes;
    }

    /**
     * @return array
     */
    public static function isExtension(): array
    {
        return static::$extensions;
    }

    /**
     * @param string $name
     * @return string
     */
    protected function name(string $name): string
    {
        $name = mb_convert_encoding(htmlspecialchars(mb_strtolower($name)), 'ISO-8859-1', 'UTF-8');
        $formats = mb_convert_encoding(
            'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]/?;:.,\\\'<>°ºª',
            'ISO-8859-1',
            'UTF-8'
        );
        $replace = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyrr                                 ';
        $name = str_replace(
            ["-----", "----", "---", "--"],
            "-",
            str_replace(" ", "-", trim(strtr($name, $formats, $replace)))
        );

        $this->name = "{$name}." . $this->ext;

        if (file_exists("{$this->path}/{$this->name}") && is_file("{$this->path}/{$this->name}")) {
            $this->name = "{$name}-" . time() . ".{$this->ext}";
        }
        return $this->name;
    }

    /**
     * @param string $dir
     * @param int $mode
     */
    protected function dir(string $dir, int $mode = 0755): void
    {
        if (!file_exists($dir) || !is_dir($dir)) {
            mkdir($dir, $mode, true);
        }
    }

    /**
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
     * @param array $file
     */
    protected function ext(array $file): void
    {
        $this->ext = mb_strtolower(pathinfo($file['name'])['extension']);
    }

    /**
     * @param $inputName
     * @param $files
     * @return array
     */
    public function multiple($inputName, $files): array
    {
        $gbFiles = [];
        $gbCount = count($files[$inputName]["name"]);
        $gbKeys = array_keys($files[$inputName]);

        for ($gbLoop = 0; $gbLoop < $gbCount; $gbLoop++):
            foreach ($gbKeys as $key):
                $gbFiles[$gbLoop][$key] = $files[$inputName][$key][$gbLoop];
            endforeach;
        endfor;

        return $gbFiles;
    }
}
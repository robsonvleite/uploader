<?php
    /**
     * Class CoffeeCode Document
     *
     * @author Tiago Chini <https://github.com/tiagochini>
     * @package CoffeeCode\Uploader
     */

    namespace CoffeeCode\Uploader;


    class Document
    {
        /**
         * Allow pdf, docx, tfm, tex, sxc, odt, odp, doc, xls, xlsm, ppt, pptm files
         *
         * @var array allowed file types
         */
        protected static $allowTypes = [
            "application/pdf",
            "application/msword",
            "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
            "application/vnd.ms-excel",
            "application/vnd.ms-excel.sheet.macroenabled.12",
            "application/vnd.openxmlformats-officedocument.presentationml.presentation",
            "application/vnd.openxmlformats-officedocument.presentationml.slide",
            "application/vnd.openxmlformats-officedocument.presentationml.slideshow",
            "application/vnd.ms-powerpoint.presentation.macroenabled.12",
            "application/vnd.ms-powerpoint",
            "application/vnd.openofficeorg.extension",
            "application/vnd.oasis.opendocument.presentation",
            "application/vnd.oasis.opendocument.text",
            "application/vnd.sun.xml.calc",
            "application/x-tex",
            "application/x-tex-tfm"
        ];

        /**
         * Send an document from a form
         *
         * @param array $document
         * @param string $name
         * @return null|string
         * @throws \Exception
         */
        public function upload(array $document, string $name): string
        {
            if (!in_array($document['type'], static::$allowTypes)) {
                throw new \Exception("{$document['type']} - Not a valid file type");
            } else {
                $this->ext = mb_strtolower(pathinfo($document['name'])['extension']);
                $this->name($name);
            }

            move_uploaded_file($document['tmp_name'], "{$this->path}/{$this->name}");
            return "{$this->path}/{$this->name}";
        }

    }
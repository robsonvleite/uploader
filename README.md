# Uploader @CoffeeCode

[![Maintainer](http://img.shields.io/badge/maintainer-@robsonvleite-blue.svg?style=flat-square)](https://twitter.com/robsonvleite)
[![Source Code](http://img.shields.io/badge/source-coffeecode/uploader-blue.svg?style=flat-square)](https://github.com/robsonvleite/uploader)
[![Latest Version](https://img.shields.io/github/release/robsonvleite/uploader.svg?style=flat-square)](https://github.com/robsonvleite/uploader/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![Build Status](https://scrutinizer-ci.com/g/robsonvleite/uploader/badges/build.png?b=master&style=flat-square)](https://scrutinizer-ci.com/g/robsonvleite/uploader/build-status/master)
[![Quality Score](https://img.shields.io/scrutinizer/g/robsonvleite/uploader.svg?style=flat-square)](https://scrutinizer-ci.com/g/robsonvleite/uploader)
[![Total Downloads](https://img.shields.io/packagist/dt/coffeecode/uploader.svg?style=flat-square)](https://packagist.org/packages/coffeecode/uploader)

###### Uploader is a set of small classes for sending images, files, documents and media received by a form of your application. The Uploader handles, validates and sends the files to your server. Image class can still handle sizes with the gd library.

Uploader é um conjunto de pequenas classes para envio de imagens, arquivos, documentos e midias recebidos por um formulário de sua aplicação. O Uploader trata, valida e envia os arquivos a seu servidor. A classe de imagem ainda consegue tratar tamanhos com a biblioteca gd.

## About CoffeeCode

###### CoffeeCode is a set of small and optimized PHP components for common tasks. Held by Robson V. Leite and the UpInside team. With them you perform routine tasks with fewer lines, writing less and doing much more.

CoffeeCode é um conjunto de pequenos e otimizados componentes PHP para tarefas comuns. Mantido por Robson V. Leite e a equipe UpInside. Com eles você executa tarefas rotineiras com poucas linhas, escrevendo menos e fazendo muito mais.

### Highlights

- Image simple upload (Simples envio de imagems)
- File simple upload (Simples envio de arquivos)
- Document simple upload (Simples envio de documentos)
- Media simple upload (Simples envio de midias)
- Managing directories with date schemas (Gestão de diretórios com esquema de datas)
- Validation of images, files, documents and media by mime-types (Valida de imagens, arquivos, documentos e mídia por mime-types)
- Composer ready and PSR-2 compliant (Pronto para o composer e compatível com PSR-2)

## Installation

Uploader is available via Composer:

```bash
"coffeecode/uploader": "^1.0"
```

or run

```bash
composer require coffeecode/uploader
```

## Documentation

###### For details on how to use the upload, see a sample folder in the component directory. In it you will have an example of use for each class. CoffeeCode Uploader works like this:

Para mais detalhes sobre como usar o upload, veja uma pasta de exemplo no diretório do componente. Nela terá um exemplo de uso para cada classe. CoffeeCode Uploader funciona assim:

#### Upload an Image

```php
<?php
require __DIR__ . "/../src/Uploader.php";
require __DIR__ . "/../src/Image.php";

$image = new CoffeeCode\Uploader\Image("uploads", "images");

if ($_FILES) {
    $upload = $image->upload($_FILES['image'], $_POST['name']);
    echo "<img src='{$upload}' width='100%'>";
}
```

#### Upload an File

```php
<?php
require __DIR__ . "/../src/Uploader.php";
require __DIR__ . "/../src/File.php";

$file = new CoffeeCode\Uploader\File("uploads", "files");

if ($_FILES) {
    $upload = $file->upload($_FILES['file'], $_POST['name']);
    echo "<p><a href='{$upload}' target='_blank'>Go</a></p>";
}
```

#### Upload an Document

```php
<?php
require __DIR__ . "/../src/Uploader.php";
require __DIR__ . "/../src/Document.php";

$document = new CoffeeCode\Uploader\Document("uploads", "files");

if ($_FILES) {
    $upload = $document->upload($_FILES['file'], $_POST['name']);
    echo "<p><a href='{$upload}' target='_blank'>Go</a></p>";
}
```

#### Upload an Media

```php
<?php
require __DIR__ . "/../src/Uploader.php";
require __DIR__ . "/../src/Media.php";

$media = new CoffeeCode\Uploader\Media("uploads", "medias");

if ($_FILES) {
    $upload = $media->upload($_FILES['file'], $_POST['name']);
    echo "<p><a href='{$upload}' target='_blank'>Acessar arquivo</a></p>";
}
```

## Contributing

Please see [CONTRIBUTING](https://github.com/robsonvleite/uploader/blob/master/CONTRIBUTING.md) for details.

## Support

###### Security: If you discover any security related issues, please email cursos@upinside.com.br instead of using the issue tracker.

Se você descobrir algum problema relacionado à segurança, envie um e-mail para cursos@upinside.com.br em vez de usar o rastreador de problemas.

Thank you

## Credits

- [Robson V. Leite](https://github.com/robsonvleite) (Developer)
- [UpInside Treinamentos](https://github.com/upinside) (Team)
- [All Contributors](https://github.com/robsonvleite/uploader/contributors) (This Rock)

## License

The MIT License (MIT). Please see [License File](https://github.com/robsonvleite/uploader/blob/master/LICENSE) for more information.
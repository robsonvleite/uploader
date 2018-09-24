<link rel="stylesheet" href="style.css">

<div class="form">
    <form name="env" method="post" enctype="multipart/form-data">
        <?php
        require __DIR__ . "/../src/Uploader.php";
        require __DIR__ . "/../src/Media.php";

        $media = new CoffeeCode\Uploader\Media("uploads", "medias");

        if ($_FILES) {
            $upload = $media->upload($_FILES['file'], $_POST['name']);
            echo "<p><a href='{$upload}' target='_blank'>Acessar arquivo</a></p>";
        }
        ?>
        <input type="text" name="name" placeholder="File Name" required/>
        <input type="file" name="file" required/>
        <button>Send Media</button>
    </form>
</div>
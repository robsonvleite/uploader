<link rel="stylesheet" href="style.css">

<div class="form">
    <form name="env" method="post" enctype="multipart/form-data">
        <?php
        require __DIR__ . "/../src/Uploader.php";
        require __DIR__ . "/../src/File.php";

        $file = new CoffeeCode\Uploader\File("uploads", "files");
        //$file->remove("uploads/files/2018/09/test.zip");

        if ($_FILES) {
            $upload = $file->upload($_FILES['file'], $_POST['name']);
            echo "<p><a href='{$upload}' target='_blank'>Acessar arquivo</a></p>";
        }
        ?>
        <input type="text" name="name" placeholder="File Name" required/>
        <input type="file" name="file" required/>
        <button>Send File</button>
    </form>
</div>
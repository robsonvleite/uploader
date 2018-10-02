<link rel="stylesheet" href="style.css">

<div class="form">
    <form name="env" method="post" enctype="multipart/form-data">
        <?php
        require __DIR__ . "/../src/Uploader.php";
        require __DIR__ . "/../src/Document.php";

        $document = new CoffeeCode\Uploader\Document("uploads", "documents");

        if ($_FILES) {
            $upload = $document->upload($_FILES['file'], $_POST['name']);
            echo "<p><a href='{$upload}' target='_blank'>Acessar arquivo</a></p>";
        }
        ?>
        <input type="text" name="name" placeholder="Document Name" required/>
        <input type="file" name="file" required/>
        <button>Send Document</button>
    </form>
</div>
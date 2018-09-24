<link rel="stylesheet" href="style.css">

<div class="form">
    <form name="env" method="post" enctype="multipart/form-data">
        <?php
        require __DIR__ . "/../src/Uploader.php";
        require __DIR__ . "/../src/Image.php";

        $image = new CoffeeCode\Uploader\Image("uploads", "images");
        //$image->remove("uploads/images/2018/09/test.gif");

        if ($_FILES) {
            $upload = $image->upload($_FILES['image'], $_POST['name']);
            echo "<img src='{$upload}' width='100%'>";
        }
        ?>
        <input type="text" name="name" placeholder="Image Name" required/>
        <input type="file" name="image" required/>
        <button>Send Image</button>
    </form>
</div>



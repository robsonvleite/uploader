<link rel="stylesheet" href="style.css">

<div class="form">
    <form name="env" method="post" enctype="multipart/form-data">
        <?php
        require __DIR__ . "/../src/Uploader.php";
        require __DIR__ . "/../src/Image.php";

        //$image = new CoffeeCode\Uploader\Image("uploads", "images", false); //SEM PASTAS DE ANO E MÊS
        $image = new CoffeeCode\Uploader\Image("uploads", "images");

        if ($_FILES) {
            try {
                $upload = $image->upload($_FILES['image'], $_POST['name']);
                echo "<img alt='' src='$upload' width='100%'>";
            } catch (Exception $e) {
                echo "<p>(!) $e->getMessage()</p>";
            }
        }
        ?>
        <label>
            <input type="text" name="name" placeholder="Image Name" required/>
        </label>
        <input type="file" name="image" required/>
        <button>Send Image</button>
    </form>
</div>



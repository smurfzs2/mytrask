<?php
$dir_path = "folder_img/";
$extensions_array = array('jpg', 'png', 'jpeg');
$images_html = "";

if (is_dir($dir_path)) {
    $files = scandir($dir_path);

    for ($i = 0; $i < count($files); $i++) {
        if ($files[$i] != '.' && $files[$i] != '..') {
            $file = pathinfo($files[$i]);
            $extension = $file['extension'];

            if (in_array($extension, $extensions_array)) {
                $images_html .= "<div class='selectable-image' data-src='$dir_path$files[$i]'>";
                $images_html .= "<img src='$dir_path$files[$i]' style='width:100px;height:100px;'>";
                $images_html .= "</div>";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        .drag-area {
            border: 2px dashed #ccc;
            padding: 20px;
            text-align: center;
        }

        .selectable-image {
            display: inline-block;
            margin: 5px;
            cursor: pointer;
        }

        .selectable-image.selected {
            border: 2px solid blue;
        }
    </style>
</head>

<body>
    <div class="drag-area" id="dragArea">
        <?php echo $images_html; ?>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const selectableImages = document.querySelectorAll(".selectable-image");

            selectableImages.forEach(function(image) {
                image.addEventListener("click", function() {
                    // Toggle selection class on click
                    this.classList.toggle("selected");
                });
            });

            const dragArea = document.getElementById("dragArea");

            dragArea.addEventListener("dragover", function(e) {
                e.preventDefault();
                this.classList.add("dragover");
            });

            dragArea.addEventListener("dragleave", function() {
                this.classList.remove("dragover");
            });

            dragArea.addEventListener("drop", function(e) {
                e.preventDefault();
                this.classList.remove("dragover");

                const selectedImages = document.querySelectorAll(".selectable-image.selected");

                if (selectedImages.length > 0) {
                    // Handle dropped images here
                    selectedImages.forEach(function(selectedImage) {
                        // Use 'selectedImage.dataset.src' to get the image source
                        console.log("Dropped image:", selectedImage.dataset.src);
                        // You can perform further actions like uploading or processing the dropped images
                    });
                } else {
                    console.log("No images selected for drop.");
                }
            });
        });
    </script>
</body>

</html>

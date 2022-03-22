<form method="POST" id="product_form">
    <div class="page-header">
        <p class="header-title">Create new Product</p>
        <div class="header-buttons">
            <button type="submit" class="btn btn-primary" id="saveButton">Save</button>
            <a href="/products" class="btn btn-light">Cancel</a>
        </div>
    </div>
    <hr>
    <?php if (!empty($errors)) : ?>
        <div class="alert alert-danger">
            <?php foreach ($errors as $error) : ?>
                <div><?php echo $error ?></div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    <div class="input-style">
        <label>SKU</label>
        <input type="text" class="form-control" id="sku" name="SKU" value="<?php echo $productData['SKU'] ?>">
    </div>
    <div class="input-style">
        <label>Name</label>
        <input type="text" class="form-control" id="name" name="Name" value="<?php echo $productData['Name'] ?>">
    </div>
    <div class="input-style">
        <label>Price</label>
        <input type="number" step=".01" class="form-control" id="price" name="Price" value="<?php echo $productData['Price'] ?>">
    </div>
    <select class="dropdown" id="productType" name="type">
        <option class="dropdown-item" value="" id="default" <?php if(($_POST['type']??'')==''):?> selected <?php endif ?> >Please Select a type</option>
        <option class="dropdown-item" value="DVD" id="DVD"<?php if(($_POST['type']??'')=='DVD'):?> selected <?php endif ?> >DVD</option>
        <option class="dropdown-item" value="Book" id="Book"<?php if(($_POST['type']??'')=='Book'):?> selected <?php endif ?> >Book</option>
        <option class="dropdown-item" value="Furniture" id="Furniture"<?php if(($_POST['type']??'')=='Furniture'):?> selected <?php endif ?> >Furniture</option>
    </select>
    <div class="input-style" id="inputSize" style="display: none">
        <label>Size (in MB)</label>
        <input type="number" class="form-control" name="Size" id="size" value="<?php echo $productData['Size'] ?>">
    </div>
    <div class="input-style" id="inputWeight" style="display: none">
        <label>Weight (in KG)</label>
        <input type="number" step=".01" class="form-control" id="weight" name="Weight" value="<?php echo $productData['Weight'] ?>">
    </div>
    <div class="input-style" id="inputHeight" style="display: none">
        <label>Height (in M)</label>
        <input type="number" step=".01" class="form-control" id="height" name="Height" value="<?php echo $productData['Height'] ?>">
    </div>
    <div class="input-style" id="inputWidth" style="display: none">
        <label>Width (in M)</label>
        <input type="number" step=".01" class="form-control" id="width" name="Width" value="<?php echo $productData['Width'] ?>">
    </div>
    <div class="input-style" id="inputLength" style="display: none">
        <label>Length (in M)</label>
        <input type="number" step=".01" class="form-control" id="length" name="Length" value="<?php echo $productData['Length'] ?>">
    </div>
</form>
<script>
    $(document).ready(function(){
        $selectedElement=$("#productType").val();
        hideAllExcept($selectedElement);
    });

    $("#productType").on("change",
        function() {
            var type = $(this).val();
            if (type == "DVD") {
                hideAllExcept('DVD');
            } else if (type == "Book") {
                hideAllExcept('Book');
            } else if (type == "Furniture") {
                hideAllExcept('Furniture');
            }
        }
    );

    $("#saveButton").on("click",function(){
        var selectedOption = $("#productType").val();
        $("#productType").val(selectedOption).select();
    });

    function hideAllExcept($element) {
        $allElements = {
            'DVD': ['inputSize'],
            'Book': ['inputWeight'],
            'Furniture': ['inputHeight', 'inputWidth', 'inputLength'],
        };

        $.each($allElements, function(index, value) {
            console.log(index);
            if (index == $element) {
                $.each(value, function(i, val) {
                    $(`#${val}`).show();
                });
            } else {
                $.each(value, function(i, val) {
                    $(`#${val}`).find("input").val('');
                    $(`#${val}`).hide();

                });
            }
        });
    }
</script>
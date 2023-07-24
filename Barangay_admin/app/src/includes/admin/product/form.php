 <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">

     <?php if (isset($errors['error_name'])) : ?>

         <div class="error">
             <?= $errors['error_name'] ?>
         </div>

     <?php endif ?>

     <div class="row">
         <div class="col-md-12">
             <div class="form-group
                                ">
                 <label for="product_name">Product Name</label>
                 <input type="text" name="product_name" id="product_name" class="form-control
                                    " placeholder="Product Name" required>

             </div>
         </div>
     </div>

     <!-- product price -->
     <div class="row">
         <div class="col-md-12">
             <div class="form-group">
                 <label for="product_price">Product Price</label>
                 <input type="number" name="product_price" id="product_price" class="form-control" placeholder="Product Price" required>
             </div>
         </div>
     </div>

     <!-- product img -->
     <div class="row">
         <div class="col-md-12">
             <div class="form-group">
                 <label for="product_img" class="">Add Image</label>
                 <input type="file" name="product_img" id="product_img" class="form-control" placeholder="Product Image" required>
             </div>
         </div>
     </div>

     <!-- submit -->
     <div class="row">
         <div class="col-md-12">
             <div class="form-group
                                ">
                 <button type="submit" name="submit" class="btn btn-primary">Add Product</button>
             </div>
         </div>
     </div>
 </form>
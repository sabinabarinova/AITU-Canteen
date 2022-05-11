<div class="container-fluid" style="margin-top:98px">
	
	<div class="col-lg-12">
		<div class="row">
			<!-- FORM Panel -->
			<div class="col-md-4">
			<form action="partials/_menuManage.php" method="post" enctype="multipart/form-data">
				<div class="card mb-3">
					<div class="card-header" style="background-color: rgb(111 202 203);">
						Create New Item
				  	</div>
					<div class="card-body">
							<div class="form-group">
								<label class="control-label">Name: </label>
								<input type="text" class="form-control" name="name" required>
							</div>
							<div class="form-group">
								<label class="control-label">Description: </label>
								<textarea cols="30" rows="3" class="form-control" name="description" required></textarea>
							</div>
                            <div class="form-group">
								<label class="control-label">Price</label>
								<input type="number" class="form-control" name="price" required min="1">
							</div>	
							<div class="form-group">
								<label class="control-label">Category: </label>
								<select name="categoryId" id="categoryId" class="custom-select browser-default" required>
								<option hidden disabled selected value>None</option>
                                <?php
                                    $catsql = "SELECT * FROM `categories`"; 
                                    $catresult = mysqli_query($conn, $catsql);
                                    while($row = mysqli_fetch_assoc($catresult)){
                                        $catId = $row['categorieId'];
                                        $catName = $row['categorieName'];
                                        echo '<option value="' .$catId. '">' .$catName. '</option>';
                                    }
                                ?>
								</select>
							</div>
							
							<div class="form-group">
								<label for="image" class="control-label">Image</label>
								<input type="file" name="image" id="image" accept=".jpg" class="form-control" required style="border:none;">
								<small id="Info" class="form-text text-muted mx-3">Please .jpg file upload.</small>
							</div>
					</div>
							
					<div class="card-footer">
						<div class="row">
							<div class="mx-auto">
								<button type="submit" name="createItem" class="btn btn-sm btn-primary"> Create </button>
							</div>
						</div>
					</div>
				</div>
			</form>
			</div>
			<!-- FORM Panel -->

			<!-- Table Panel -->
			<div class="col-md-8">
				<div class="card">
					<div class="card-body">
						<table class="table table-bordered table-hover mb-0">
							<thead style="background-color: rgb(111 202 203);">
								<tr>
									<th class="text-center" style="width:7%;">Cat. Id</th>
									<th class="text-center">Img</th>
									<th class="text-center" style="width:58%;">Item Detail</th>
									<th class="text-center" style="width:18%;">Action</th>
								</tr>
							</thead>
							<tbody>
                            <?php
                                $sql = "SELECT * FROM `products`";
                                $result = mysqli_query($conn, $sql);
                                while($row = mysqli_fetch_assoc($result)){
                                    $prodID = $row['prodID'];
                                    $prodName = $row['prodName'];
                                    $prodPrice = $row['prodPrice'];
                                    $prodDesc = $row['prodDesc'];
                                    $prodCategorieId = $row['prodCategorieId'];

                                    echo '<tr>
                                            <td class="text-center">' .$prodCategorieId. '</td>
                                            <td>
                                                <img src="/AITUCanteen/img/pizza-'.$prodID. '.jpg" alt="image for this item" width="150px" height="150px">
                                            </td>
                                            <td>
                                                <p>Name : <b>' .$prodName. '</b></p>
                                                <p>Description : <b class="truncate">' .$prodDesc. '</b></p>
                                                <p>Price : <b>' .$prodPrice. '</b></p>
                                            </td>
                                            <td class="text-center">
												<div class="row mx-auto" style="width:112px">
													<button class="btn btn-sm btn-primary" type="button" data-toggle="modal" data-target="#updateItem' .$prodID. '">Edit</button>
													<form action="partials/_menuManage.php" method="POST">
														<button name="removeItem" class="btn btn-sm btn-danger" style="margin-left:9px;">Delete</button>
														<input type="hidden" name="prodID" value="'.$prodID. '">
													</form>
												</div>
                                            </td>
                                        </tr>';
                                }
                            ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- Table Panel -->
		</div>
	</div>	
</div>

<?php 
    $productsql = "SELECT * FROM `products`";
    $productResult = mysqli_query($conn, $productsql);
    while($productRow = mysqli_fetch_assoc($productResult)){
        $prodID = $productRow['prodID'];
        $prodName = $productRow['prodName'];
        $prodPrice = $productRow['prodPrice'];
        $prodCategorieId = $productRow['prodCategorieId'];
        $prodDesc = $productRow['prodDesc'];
?>

<!-- Modal -->
<div class="modal fade" id="updateItem<?php echo $prodID; ?>" tabindex="-1" role="dialog" aria-labelledby="updateItem<?php echo $prodID; ?>" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color: rgb(111 202 203);">
        <h5 class="modal-title" id="updateItem<?php echo $prodID; ?>">Item Id: <?php echo $prodID; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  	<form action="partials/_menuManage.php" method="post" enctype="multipart/form-data">
		    <div class="text-left my-2 row" style="border-bottom: 2px solid #dee2e6;">
		   		<div class="form-group col-md-8">
					<b><label for="image">Image</label></b>
					<input type="file" name="itemimage" id="itemimage" accept=".jpg" class="form-control" required style="border:none;" onchange="document.getElementById('itemPhoto').src = window.URL.createObjectURL(this.files[0])">
					<small id="Info" class="form-text text-muted mx-3">Please .jpg file upload.</small>
					<input type="hidden" id="prodID" name="prodID" value="<?php echo $prodID; ?>">
					<button type="submit" class="btn btn-success my-1" name="updateItemPhoto">Update Img</button>
				</div>
				<div class="form-group col-md-4">
					<img src="/AITUCanteen/img/pizza-<?php echo $prodID; ?>.jpg" id="itemPhoto" name="itemPhoto" alt="item image" width="100" height="100">
				</div>
			</div>
		</form>
		<form action="partials/_menuManage.php" method="post">
            <div class="text-left my-2">
                <b><label for="name">Name</label></b>
                <input class="form-control" id="name" name="name" value="<?php echo $prodName; ?>" type="text" required>
            </div>
			<div class="text-left my-2 row">
				<div class="form-group col-md-6">
                	<b><label for="price">Price</label></b>
                	<input class="form-control" id="price" name="price" value="<?php echo $prodPrice; ?>" type="number" min="1" required>
				</div>
				<div class="form-group col-md-6">
					<b><label for="catId">Category Id</label></b>
                	<input class="form-control" id="catId" name="catId" value="<?php echo $prodCategorieId; ?>" type="number" min="1" required>
				</div>
            </div>
            <div class="text-left my-2">
                <b><label for="desc">Description</label></b>
                <textarea class="form-control" id="desc" name="desc" rows="2" required minlength="6"><?php echo $prodDesc; ?></textarea>
            </div>
            <input type="hidden" id="prodID" name="prodID" value="<?php echo $prodID; ?>">
            <button type="submit" class="btn btn-success" name="updateItem">Update</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php
	}
?>
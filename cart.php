<?php
session_start();
$database_name = "product_details";
$con = mysqli_connect(host: "localhost" , user: "root" , password:"" , $database_name);

 ?>





<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>SHOPPING CART</title>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<style>
@import url('https://fonts.googleapis.com/css?family=Titillium+Web&display=swap');
*{
  font-family: 'Titillium Web', sans-serif;
}
.product{
  border: 1px solid #eaeaec;
  margin: -1 19px 3px -1px;
  padding: 10px;
  text-align: center;
  background-color: #efefef;
}

table, th, tr{
  text-align: center;
}
.title2{
  text-align: center;
  color: yellow;
  background-color: white;
  padding: 2%;
}
h2{
  text-align: center;
  color: red;
  background-color: white;
  padding: 2%;
}

table th{
  background-color:yellow;

}
</style>

  </head>
  <body>
    <div class="container" style="width: 65%">
      <h2>Shopping Cart 1</h2>
<?php
$query = "SELECT * FROM Product ORDER BY id ASC ";
$result = mysqli_query($con,$query);
if(mysqli_num_rows($result) > 0){
  while ($row = mysqli_fetch_array($result)){



 ?>

<div class="col-md-3">
  <form method="post" action="cart.php?action=add&id=<?php echo $row["id"]?>" >
    <div class="product">
      <img src="<?php echo $row["image"]; ?>" class="img-responsive">
      <h5 class="text-info"> <?php $row["pname"]; ?> </h5>
      <h5 class="text-danger"> <?php $row["price"];  ?> </h5>
      <input type="text" name="quantity" class="form-control" value="1">
      <input type="hidden" name="hidden_name" value="<?php echo $row["pname"]; ?>">
      <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>">
      <input type="submit" name="add" style="margin-top: 5px;" class="btn btn-success" value="Add to cart">


    </div>
  </form>
</div>

<?php
}
}
 ?>
<div style="clear: both"></div>
<h3 class="title2">Shopping Cart Details</h3>
<div class="table table-bordered">
  <tr>
    <th width="30%">Product Name</th>
    <th width="10%">Quantity</th>
    <th width="13%">Price</th>
    <th width="10%">Total Price</th>
    <th width="17%">Remove</th>
  </tr>

<?php
if(!empty($_SESSION["cart"])){
  $total = 0;
  foreach ($_SESSION["cart"] as $key => $value) {


    ?>
<tr>
  <td><?php echo $value["item_name"]; ?></td>
  <td><?php echo $value["item_quantity"];?></td>
  <td>$ <?php echo $value["product_price"]; ?></td>
  <td>$ <?php echo number_format($value["item_quantity"] * $value["product_price"], decimals: 2); ?></td>
  <td> <a href="cart.php?action=delete&id=<?php echo $value["product_id"]; ?>"> <span class="text-danger"> Remove Item </span> </a> </td>
</tr>

<?php
$total = $total + ($value["item_quantity"] * $value["product_price"] );
}
 ?>
  <tr>
    <td colspan="3" align="right">Total Price</td>
    <th align="right"> $ <?php echo number_format($total, decimals: 2); ?></th>
    <td></td>
  </tr>
  <?php
}
  ?>
</div>

    </div>
  </body>
</html>

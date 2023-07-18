<?php
// Check form data if user clicks add to cart
if (isset($_POST['product_id'], $_POST['quantity']) && is_numeric($_POST['product_id']) && is_numeric($_POST['quantity'])) {
  // Verify integer and set post values
  $product_id = (int)$_POST['product_id'];
  $quantity = (int)$_POST['quantity'];
  // Check if product exists in database and prepare SQL statement
  $stmt = $pdo->prepare('SELECT * FROM discs WHERE DiscID = ?');
  $stmt->execute([$_POST['product_id']]);
  // Fetch the product from the database and return the result as an Array
  $product = $stmt->fetch(PDO::FETCH_ASSOC);
  // Check if the product exists (array is not empty)
  if ($product && $quantity > 0) {
    // Product exists in database, create/update session variable for cart
    if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
      if (array_key_exists($product_id, $_SESSION['cart'])) {
        // Product exists in cart so just update the quanity
        $_SESSION['cart'][$product_id] += $quantity;
      } else {
        // Product is not in cart so add it
        $_SESSION['cart'][$product_id] = $quantity;
      }
    } else {
      // There are no products in cart, this will add the first product to cart
      $_SESSION['cart'] = array($product_id => $quantity);
    }
  }
  // Prevent form resubmission...
  header('location: index.php?page=cart');
  exit;
}

// Remove product from cart, check for the URL param "remove", this is the product id, make sure it's a number and check if it's in the cart
if (isset($_GET['remove']) && is_numeric($_GET['remove']) && isset($_SESSION['cart']) && isset($_SESSION['cart'][$_GET['remove']])) {
  // Remove the product from the shopping cart
  unset($_SESSION['cart'][$_GET['remove']]);
}

// Update product qtys when user clicks update
if (isset($_POST['update']) && isset($_SESSION['cart'])) {
  // Look through post data to update every product in cart
  foreach ($_POST as $k => $v) {
    if (strpos($k, 'quantity') !== false && is_numeric($v)) {
      $id = str_replace('quantity-', '', $k);
      $quantity = (int)$v;
      // Validation check
      if (is_numeric($id) && isset($_SESSION['cart'][$id]) && $quantity > 0) {
        // Update new quantity
        $_SESSION['cart'][$id] = $quantity;
      }
    }
  }
  // Prevent form resubmission...
  header('location: index.php?page=cart');
  exit;
}

// Check for empty cart and send user to place order page
if (isset($_POST['placeorder']) && isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
  header('Location: index.php?page=placeorder');
  exit;
}

// Check the session variable for products in cart
$products_in_cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
$products = array();
$subtotal = 0.00;
// If there are products in cart
if ($products_in_cart) {
  // Select products from database
  // Products in cart array to question mark string array, we need the SQL statement to include IN (?,?,?,...etc)
  $array_to_question_marks = implode(',', array_fill(0, count($products_in_cart), '?'));
  $stmt = $pdo->prepare('SELECT * FROM discs LEFT JOIN company ON discs.Brand = company.CompanyID WHERE DiscID IN (' . $array_to_question_marks . ')');
  // We only need the array keys, not the values, the keys are the id's of the products
  $stmt->execute(array_keys($products_in_cart));
  // Fetch the products from the database and return the result as an Array
  $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
  // Calculate the subtotal
  foreach ($products as $product) {
    $subtotal += ($product['Price'] * $products_in_cart[$product['DiscID']]);
  }
}
?>

<?= template_header('Cart') ?>

<div class="p-4"> <!-- cart content wrapper -->
  <div class="flex flex-row justify-between border-b-2 border-white mb-4"> <!-- heading wrapper -->
    <p class="text-3xl tracking-wider">Your Cart</p>
    <a href="index.php?page=products" class="hover:underline text-3xl tracking-wide hover:font-bold">Continue Shopping</a>
  </div>

  <form action="index.php?page=cart" method="post">
    <div class="text-black relative overflow-x-auto shadow-md md:rounded-lg">
      <table class="w-full text-sm uppercase mb-5">
        <thead class="uppercase border-b border-black">
          <tr>
            <th scope="col" class="px-6 py-3"><span class="sr-only">Image</span></th>
            <th scope="col" class="px-6 py-3">Product</td>
            <th scope="col" class="px-6 py-3">Price</td>
            <th scope="col" class="px-6 py-3">Quantity</td>
            <th scope="col" class="px-6 py-3">Total</td>
          </tr>
        </thead>
        <tbody class="text-center">
          <?php if (empty($products)) : ?>
            <tr>
              <td colspan="5" style="text-align:center">You have no products added in your Shopping Cart</td>
            </tr>
          <?php else : ?>
            <?php foreach ($products as $product) : ?>
              <tr class="border-b">
                <td class="w-32 p-4">
                  <img src="img/StockDisc/<?= $product['StockImage'] ?>" alt="<?= $product['Name'] ?>" class="rounded-full">
                </td>
                <td class="px-6 py-4 font-semibold">
                  <?= $product['CompanyName'] ?></span><br> <?= $product['Name'] ?>
                </td>
                <td class="px-6 py-4">&dollar;<?= $product['Price'] ?>
                </td>
                <td class="px-6 py-4">
                  <input type="number" name="quantity-<?= $product['DiscID'] ?>" value="<?= $products_in_cart[$product['DiscID']] ?>" min="1" max="<?= $product['Quantity'] ?>" placeholder="Quantity" required>
                  
                </td>
                <td class="px-6 py-4 font-semibold">&dollar; <?= number_format(($product['Price'] * $products_in_cart[$product['DiscID']]), 2) ?></td>
                <td class="px-6 py-4">
                  <a href="index.php?page=cart&remove=<?= $product['DiscID'] ?>" class="bg-black text-sm text-white py-2 px-4 rounded-lg hover:underline hover:font-bold">Remove</a>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
      </table>
      <div class="text-right p-4">
        <input 
        type="submit" 
        value="Update" 
        name="update"
        class="bg-black text-white py-2 px-4 rounded-lg hover:underline hover:font-bold mb-4"><br>
        <p class="text-white tracking-wide text-2xl mb-4">Subtotal =
        <span class="text-2xl text-green-600 font-bold tracking-widest bg-white p-2">&dollar; <?= number_format($subtotal, 2) ?></span></p>
        <input 
        type="submit"
        value="Place Order"
        name="placeorder"
        class="bg-blue-600 text-white py-2 px-4 rounded-lg hover:underline hover:font-bold"><br>

      </div>
    </div>
  </form>
</div>



<?= template_footer() ?>
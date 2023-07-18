<?php
// Check to make sure the id parameter is specified in the URL
if (isset($_GET['id'])) {
  // Prepare statement and execute, prevents SQL injection
  $stmt = $pdo->prepare('SELECT * FROM discs LEFT JOIN company ON discs.Brand = company.CompanyID WHERE DiscId = ?');
  $stmt->execute([$_GET['id']]);
  // Fetch the product from the database and return the result as an Array
  $product = $stmt->fetch(PDO::FETCH_ASSOC);
  // Check if the product exists (array is not empty)
  if (!$product) {
    // Simple error to display if the id for the product doesn't exists (array is empty)
    exit('Product does not exist!');
  }
} else {
  // Simple error to display if the id wasn't specified
  exit('Product does not exist!');
}
?>
<?php $maxqty = $product['Quantity'] ?>

<?= template_header('Product') ?>


<div class="mx-4 md:grid md:grid-cols-2"> <!-- product page content wrapper -->
  <div class="p-12 hover:scale-110 md:place-self-center md:flex md:flex-none"> <!-- image wrapper -->
    <img src="img/StockDisc/<?= $product['StockImage'] ?>" alt="<?= $product['Name'] ?>" class="mb-4 rounded-full md:max-h-[400px] md:flex-1">
  </div>

  <div class="md:p-6 text-center md:text-start"> <!-- Information, price, and quantity, reactive on medium screens -->
    <div> <!-- information wrapper -->
      <h3 class="text-black font-bold text-3xl mb-2 leading-loose md:leading-tight md:text-5xl md:mb-4"><span class="uppercase md:text-lg"><?= $product['CompanyName'] ?></span><br> <?= $product['Name'] ?></h3>
      <p class="text-black text-2xl md:text-3xl">&dollar; <span class="text-green-600"><?= $product['Price'] ?></span> USD</p><br>
      <p class="text-black text-2xl md:mb-2">Hurry! There are only <?= $product['Quantity'] ?> in stock!</p><br>
      <div id="data-name" class="hidden"> <!-- create DOM to pass max quantity to javascript -->
        <?php
        $maxqty = $product['Quantity'];
        echo htmlspecialchars($maxqty);
        ?>
      </div>
    </div>
    <div class="md:ml-8 custom-number-input w-32 mb-2 md:scale-150 md:mb-6">
      <label for="custom-input-number" class="w-full text-black font-semibold">Select Quantity
      </label>
      <div class="flex flex-row h-10 w-full rounded-lg relative bg-transparent mt-1">
        <button data-action="decrement" class=" bg-gray-300 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-full w-20 rounded-l cursor-pointer outline-none">
          <span class="m-auto text-2xl font-thin">−</span>
        </button>
        <input type="number" id="productQTY" form="addCart" class="focus:outline-none text-center w-full bg-gray-300 font-semibold text-md hover:text-black focus:text-black  md:text-basecursor-default flex items-center text-gray-700 outline-none" name="quantity" value="1"></input>
        <button data-action="increment" class="bg-gray-300 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-full w-20 rounded-r cursor-pointer">
          <span class="m-auto text-2xl font-thin">+</span>
        </button>
      </div>
    </div>
    <div> <!-- Add to cart -->
      <form action="index.php?page=cart" method="post" id="addCart">
        <input type="hidden" name="product_id" value="<?= $product['DiscID'] ?>"></input>
        <input type="submit" class="mb-2 w-full border-8 border-black mx-auto py-2 text-black font-bold cursor-pointer hover:text-white hover:border-white hover:underline" value="Add To Cart"></input>
      </form>
    </div>
  </div>


  <div class="border-2 border-white p-4 font-bold text-center md:col-span-2 md:m-6"> <!-- product description -->
    <p class="text-2xl"><?= $product['DiscDescription'] ?></p>
  </div>
</div>

<!-- create variable for max qty to push to javascript for increment/decrement script -->
<?php $quantity = $product['Quantity'] ?>;
<script>
  var maxqty = "<?php echo "$quantity" ?>";
</script>




<?= template_footer() ?>
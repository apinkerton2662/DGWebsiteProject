<?php

//GET sort method
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'sort3';

// The amounts of products to show on each page
$num_products_on_each_page = 6;
// The current page appearing in the URL
$current_page = isset($_GET['p']) && is_numeric($_GET['p']) ? (int)$_GET['p'] : 1;
// sorting SQL calls
if ($sort == 'sort1') {
  // sort1 = Sort by Speed
  $stmt = $pdo->prepare('SELECT * FROM discs LEFT JOIN company ON discs.Brand = company.CompanyID ORDER BY Speed DESC LIMIT ?,?');
} elseif ($sort == 'sort2') {
  // sort2 = Sort by Glide
  $stmt = $pdo->prepare('SELECT * FROM discs LEFT JOIN company ON discs.Brand = company.CompanyID ORDER BY Glide DESC LIMIT ?,?');
} elseif ($sort == 'sort3') {
  // sort3 = Sort by Turn
  $stmt = $pdo->prepare('SELECT * FROM discs LEFT JOIN company ON discs.Brand = company.CompanyID ORDER BY Turn DESC LIMIT ?,?');
} elseif ($sort == 'sort4') {
  // sort4 = Sort by Fade
  $stmt = $pdo->prepare('SELECT * FROM discs LEFT JOIN company ON discs.Brand = company.CompanyID ORDER BY Fade DESC LIMIT ?,?');
} elseif ($sort == 'sort5') {
  // sort5 = Filter Drivers
  $stmt = $pdo->prepare("SELECT * FROM discs LEFT JOIN company ON discs.Brand = company.CompanyID WHERE discs.Type = 'Driver' ORDER BY discs.DiscID DESC LIMIT ?,?");
} elseif ($sort == 'sort6') {
  // sort6 = Filter Mid-Ranges
  $stmt = $pdo->prepare("SELECT * FROM discs LEFT JOIN company ON discs.Brand = company.CompanyID WHERE discs.Type = 'Mid-Range' ORDER BY discs.DiscID DESC LIMIT ?,?");
} elseif ($sort == 'sort7') {
  // sort7 = Filter Putters
  $stmt = $pdo->prepare("SELECT * FROM discs LEFT JOIN company ON discs.Brand = company.CompanyID WHERE discs.Type = 'Putter' ORDER BY discs.DiscID DESC LIMIT ?,?");
} else {
  $stmt = $pdo->prepare('SELECT * from discs LEFT JOIN company ON discs.Brand = company.CompanyID ORDER BY DiscID ASC LIMIT ?,?');
}
  



// bindValue to use in SQL statement
$stmt->bindValue(1, ($current_page - 1) * $num_products_on_each_page, PDO::PARAM_INT);
$stmt->bindValue(2, $num_products_on_each_page, PDO::PARAM_INT);
$stmt->execute();
// Fetch the products from the database and return the result as an Array
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Get total number of products
$total_products = $pdo->query('SELECT * FROM discs')->rowCount();
?>

<?= template_header('Products') ?>

<div class="mx-10 mb-5">
  <h2 class="text-4xl text-center mb-5 font-bold underline">All Discs</h2>
  <div class="flex flex-row flex-nowrap justify-around text-black">
    <label class="sortby">Sort or Filter by: 
      <select>
        <option value="sort1" <?= ($sort == 'sort1' ? ' selected' : '') ?>>Sort by Speed</option>
        <option value="sort2" <?= ($sort == 'sort2' ? ' selected' : '') ?>>Sort by Glide</option>
        <option value="sort3" <?= ($sort == 'sort3' ? ' selected' : '') ?>>Sort by Turn</option>
        <option value="sort4" <?= ($sort == 'sort4' ? ' selected' : '') ?>>Sort by Fade</option>
        <option value="sort5" <?= ($sort == 'sort5' ? ' selected' : '') ?>>Filter Drivers</option>
        <option value="sort6" <?= ($sort == 'sort6' ? ' selected' : '') ?>>Filter Mid-Ranges</option>
        <option value="sort7" <?= ($sort == 'sort7' ? ' selected' : '') ?>>Filter Putters</option>

      </select>
    </label>
    <p><?= $total_products ?> Total Discs</p>
  </div>
</div>



<div class="mb-4 grid gap-4 grid-cols-[repeat(auto-fill,minmax(300px,1fr))]">
  <?php foreach ($products as $product) : ?>

    <div class="w-md bg-primary border border-gray-200 rounded-lg shadow grid grid-cols-2 auto-cols-fr">
      <img class="col-span-2 p-4 transform scale-75 hover:scale-100 transition-all rounded-full" src="img/StockDisc/<?= $product['StockImage'] ?>" alt="<?= $product['Name'] ?>">
      <h5 class="p-4 text-xl text-center font-semibold col-span-2 tracking-tight"><span class="uppercase"><?= $product['CompanyName'] ?></span><br> <?= $product['Name'] ?></h5>
      <p class="p-4 text-2xl inline-block col-span-1 text-center self-center font-bold text-green-700">&dollar;<?= $product['Price'] ?></p>
      <a href="index.php?page=product&id=<?= $product['DiscID'] ?>" class="text-white bg-blue-500 hover:bg-blue-700 hover:font-bold rounded-full text-lg text-center self-center m-auto p-2 hover:scale-110">View Options</a>

    </div>
  <?php endforeach; ?>
</div>



<div class="mb-4 flex justify-between">
  <?php if ($current_page > 1) : ?>
    <a href="index.php?page=products&p=<?= $current_page - 1 ?>" class="text-white bg-blue-500 hover:bg-blue-700 hover:font-bold rounded-full px-6 text-lg text-center self-center m-auto p-2 hover:scale-110 hover:underline">Prev</a>
  <?php endif; ?>
  <?php if ($total_products > ($current_page * $num_products_on_each_page) - $num_products_on_each_page + count($products)) : ?>
    <a href="index.php?page=products&p=<?= $current_page + 1 ?>" class="text-white bg-blue-500 hover:bg-blue-700 hover:font-bold rounded-full px-6 text-lg text-center self-center m-auto p-2 hover:scale-110 hover:underline">Next</a>
  <?php endif; ?>
</div>

<?= template_footer() ?>
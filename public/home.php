<?php
// Get 4 products for card
$stmt = $pdo->prepare('SELECT * FROM discs LEFT JOIN company ON discs.Brand = company.CompanyID ORDER BY RAND() DESC LIMIT 4');
$stmt->execute();
$featured_products = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (!isset($_SESSION['loggedin'])) {
  $_SESSION['firstname'] = 'Fellow Disc Golfer';
}
?>

<?= template_header('Home') ?> <!-- include header -->

<p class="text-center">Welcome Back <?= $_SESSION['firstname'] ?>!</p> <!-- display user name if logged in -->

<!-- Koops picture -->
<div class="block relative w-full h-96 bg-cover bg-no-repeat bg-center mb-4" style="background-image: url(img/CourseRainbow.jpg)">
  <div class="text-center absolute w-full object-none object-center top-60">
    <a href="index.php?page=products" class="border-8 inline-block border-white rounded-lg font-bold text-3xl py-3 px-5 mb-4 mx-auto transition-all hover:scale-110">Shop All</a>
    <h1 class="text-4xl font-bold tracking-tight leading-none mx-auto block">Visit Often for New Inventory</h1>
  </div>
</div>

<div class="mx-10 mb-5">
  <!-- Featured Products Section -->
  <h2 class="text-4xl text-center mb-5 font-bold">Featured Products</h2>
  <div class="grid gap-4 grid-cols-[repeat(auto-fill,minmax(300px,1fr))]"> <!-- product cards -->

    <?php foreach ($featured_products as $product) : ?>

      <div class="w-md bg-primary border border-gray-200 rounded-lg shadow grid grid-cols-2 auto-cols-fr">
        <img class="rounded-full col-span-2 self-stretch p-4 transform scale-75 hover:scale-100 transition-all" src="img/StockDisc/<?= $product['StockImage'] ?>" alt="<?= $product['Name']?>">
        <h5 class="p-4 text-xl text-center text-black font-semibold col-span-2 tracking-tight"><span class="uppercase"><?= $product['CompanyName'] ?></span><br> <?= $product['Name'] ?></h5>
        <p class="p-4 text-2xl inline-block col-span-1 text-center self-center font-bold text-green-700">&dollar;<?= $product['Price'] ?></p>
        <a href="index.php?page=product&id=<?= $product['DiscID'] ?>" class="text-white bg-blue-500 hover:bg-blue-700 hover:font-bold rounded-full text-lg text-center self-center m-auto p-2 hover:scale-110">View Options</a>

      </div>


    <?php endforeach; ?>


  </div>
</div>

<article class="text-center p-5 text-lg italic">
  <h3>Why us?</h3>
  <br>
  <p>
  We realise that there are cheaper options than local resellers.  But here at Full Send Disc Golf, we offer something the big brands can't.  We're local!  We know the local routes, we know what you want, and we know what you throw.  We'll be there watching you every league round, anticipating your needs.  
  </p>
  <br>
  <p>
    I bet the next time you visit our store, whether online or in store, you'll find the disc you need on the shelf.
  </p>
  <br>
  <p>As the saying goes, "Happy customers keep coming back. That's our priority!"</p>
  <br>
</article>

<div class="mx-auto w-auto flex flex-row flex-wrap justify-around">
  <!-- link cards go here -->
  <div class="max-w-xs bg-primary">
    <img class="p-8 m-auto" src="img/KermitLostDisc.jpg" alt="Lost discs?" />
    <div class="px-5 pb-5 text-center">
      <h2 class="text-xl">Lost a Disc?</h2>
      <br>
      <p class="text-sm italic">"Does it think of me too?"</p>
      <p class="text-sm">No, but we do!</p>
      <br>
      <a class="hover:font-bold hover:underline" href="index.php?page=products">Shop for a replacement driver</a>
    </div>
  </div>

  <div class="max-w-xs bg-primary">
    <img class="p-8 m-auto" src="img/NeedDiscs.jpg" alt="Need Discs?" />
    <div class="px-5 pb-5 text-center">
      <h2 class="text-xl">Lose track of a practice throw?</h2>
      <br>
      <p class="text-sm italic">"I think I found them all."</p>
      <p class="text-sm">- No one...ever.</p>
      <br>
      <a class="hover:underline hover:font-bold" href="index.php?page=products">Replace that mid-range you lost</a>
    </div>
  </div>

  <div class="max-w-xs bg-primary">
    <img class="p-8 m-auto" src="img/WindyPutt.jpg" alt="Need Discs?" />
    <div class="px-5 pb-5 text-center">
      <h2 class="text-xl">Need a heavier putter?</h2>
      <br>
      <p class="text-sm italic">"You're still out."</p>
      <p class="text-sm">Worst words in disc golf. Period.</p>
      <br>
      <a class="hover:font-bold hover:underline transition-all" href="index.php?page=products">Shop putters</a>
    </div>
  </div>
</div>

<article class="w-1/2 mx-auto text-center lg:w-3/4">
  <h2 class="text-4xl text-center my-5">Essential External Sites</h2>
  <ul>
    <li class="border-t mb-2 border-b py-3 hover:underline hover:font-bold">
      <a href="http://www.facebook.com">Full Bid Disc Golf Facebook Group</a>
    </li>
    <li class="border-b mb-2 pb-3 hover:underline hover:font-bold">
      <a href="http://hawaiidiscgolfadventures.com">Hawaii Disc Golf Adventures</a>
    </li>
    <li class="border-b pb-3 hover:underline hover:font-bold">
      <a href="http://honoluludiscgolf.com">Honolulu Disc Golf Association</a>
    </li>
  </ul>
</article>

<?= template_footer() ?>
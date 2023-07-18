<?php
function pdo_connect_mysql()
{
  // Update the details below with your MySQL details
  $DATABASE_HOST = 'localhost';
  $DATABASE_USER = 'root';
  $DATABASE_PASS = '1234';
  $DATABASE_NAME = 'fullsenddb';
  try {
    return new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
  } catch (PDOException $exception) {
    // If there is an error with the connection, stop the script and display the error.
    exit('Failed to connect to database!');
  }
}


// Template header for inclusion on all pages
function template_header($title)
{
  $num_items_in_cart = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
  echo <<<HTML
<!DOCTYPE html>

<html lang="en">

  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>$title</title>
    <link href="/fullsenddg/public/css/styles.css" rel="stylesheet" />
    <script
      src="https://kit.fontawesome.com/8bcf79d31f.js"
      crossorigin="anonymous"
    ></script>
  </head>
  <!-- set global color scheme -->
  <body class="bg-primary text-white font-body">
    <div class="text-xs tracking-widest text-center leading-4">
      <!-- top announcements wrapper, can add dynamic content later -->
      <div
        class="border-b border-white border-opacity-20 py-3 px-8 hover:underline hover:font-bold"
      >
        <p>
          Aloha and Welcome to Oahu's First Online Disc Golf Pro Shop! The
          Largest Disc Golf Inventory on the island!
        </p>
      </div>
      <div
        class="border-b border-white border-opacity-20 py-3 px-8 hover:underline hover:font-bold"
      >
        <p>Your Local Hawaii Disc Golf Retailer</p>
      </div>
      <div
        class="border-b border-white border-opacity-20 py-3 px-8 hover:underline hover:font-bold"
      >
        <p>
          Check Us Out On Facebook For New Release Information<a
            href="http://www.facebook.com"
            ><i class="fa-solid fa-arrow-right"></i
          ></a>
        </p>
      </div>
    </div>

    <div class="grid grid-cols-[1fr_2fr_1fr] my-6">
      <!-- wrapper for logo bar -->

      <nav class="self-center ml-4">
        <!-- small screen nav, hidden unti clicked -->
        <div
          class="lg:hidden text-white"
          id="dropdownNavBars"
          data-dropdown-toggle="dropdownNav"
        >
          <!-- Uses flowbite to create dropdown nav -->
          <i class="fa-xl fa-solid fa-bars hover:scale-110"></i>
        </div>
        <div id="dropdownNav" class="hidden z-10">
          <ul
            class="text-sm border-2 border-white bg-teal-300 text-black z-10 rounded-lg shadow-lg"
            id="dropdownNav"
          >
            <li>
              <a
                href="index.php?page=home"
                class="block py-2 pl-3 pr-4 rounded hover:underline hover:scale-110"
                >Home</a
              >
            </li>
            <li>
              <a
                href="index.php?page=products"
                class="block py-2 pl-3 pr-4 rounded hover:underline hover:scale-110"
                >Shop All Discs</a
              >
            </li>
            <li>
              <a
                href="index.php?page=products&sort=sort5"
                class="block py-2 pl-3 pr-4 rounded hover:underline hover:scale-110"
                >Drivers</a
              >
            </li>
            <li>
              <a
                href="index.php?page=products&sort=sort6"
                class="block py-2 pl-3 pr-4 rounded hover:underline hover:scale-110"
                >Mid-Ranges</a
              >
            </li>
            <li>
              <a
                href="index.php?page=products&sort=sort7"
                class="block py-2 pl-3 pr-4 rounded hover:underline hover:scale-110"
                >Putters</a
              >
            </li>
          </ul>
        </div>
      </nav>

      <div class="h-full col-start-2 self-center justify-self-center">
        <!-- logo -->
        <img
          src="img/FullSendDiscGolf.jpg"
          alt="Send It"
          height="200px"
          width="300px"
        />
      </div>

      <div
        class="col-start-3 self-center mr-4 justify-self-end items-center inline-flex space-x-4"
      >
        <a href="index.php?page=login" data-tooltip-target="ttlogin"
          ><i class="fa-solid fa-user-lock hover:scale-110"></i
        ></a>
        <div id="ttlogin" role="tooltip" class="absolute z-10 invisible inline-block p-2 text-sm font-medium text-black transition-opacity duration-300 bg-white rounded-lg shadow-sm opacity-0 tooltip">
          Login
            <div class="tooltip-arrow" data-popper-arrow></div>
        </div>
        <a href="index.php?page=logout" data-tooltip-target="ttlogout"
          ><i class="fa-solid fa-user-slash hover:scale-110"></i
        ></a>
        <div id="ttlogout" role="tooltip" class="absolute z-10 invisible inline-block p-2 text-sm font-medium text-black transition-opacity duration-300 bg-white rounded-lg shadow-sm opacity-0 tooltip">
          Logout
            <div class="tooltip-arrow" data-popper-arrow></div>
        </div>
        <a href="index.php?page=cart" data-tooltip-target="ttcart"
          ><i class="fa-solid fa-cart-shopping hover:scale-110"></i
        ></a>
        <div id="ttcart" role="tooltip" class="absolute z-10 invisible inline-block p-2 text-sm font-medium text-black transition-opacity duration-300 bg-white rounded-lg shadow-sm opacity-0 tooltip">
          Cart
            <div class="tooltip-arrow" data-popper-arrow></div>
        </div>
      </div>
    </div>

    <nav class="hidden lg:block justify-self-center text-center">
      <ul class="inline-flex flex-row flex-wrap">
        <li class="text-base hover:font-bold hover:underline p-4">
          <a href="index.php">Home</a>
        </li>
        <li class="text-base hover:font-bold hover:underline p-4">
          <a href="index.php?page=products">Discs</a>
        </li>
        <li class="text-base hover:font-bold hover:underline p-4">
          <a href="index.php?page=products&sort=sort5">Drivers</a>
        </li>
        <li class="text-base hover:font-bold hover:underline p-4">
          <a href="index.php?page=products&sort=sort6">Mid-Ranges</a>
        </li>
        <li class="text-base hover:font-bold hover:underline p-4">
          <a href="index.php?page=products&sort=sort7">Putters</a>
        </li>
      </ul>
    </nav>
    <main>
HTML;
}
// Template footer 

function template_footer() 
{
  echo <<<HTML
    </main>
    <footer>
      <div class="grid grid-cols-2 border-t-2 border-white">
        <div class="p-4 text-center border-r-2 border-white">
          <!-- Mission -->
          <h2 class="font-bold">Our Mission</h2>
          <br>
          <p>
            To provide quality disc golf equipment, accessories, and apparel to
            the Hawaii disc golf community at desirable prices.
          </p>
          <br>
          <p>
            Our focus is on providing quality products, premier customer
            service, and the convenience of shopping local without the hassle of
            dealing with long shipping wait times and the increased presence of
            interactions with social media scammers.
          </p>
          <br>
          <p>
            Allow us to prove to you that our customers and the sport are our
            leading priority.
          </p>
          <br>
        </div>

        <div class="p-4 text-center">
          <!-- Vision -->
          <h2 class="font-bold">Our Vision</h2>
          <br />
          <p>
            To grow the sport along side and in support of the Honolulu Disc
            Golf Association, Honolulu Joint Military Disc Golf Club, and Oahu
            Disc Golf.
          </p>
          <br />
          <p>
            Together, we will make a positive impact on the local and disc golf
            community as we become a world renowned disc golf destination.
          </p>
          <br />
        </div>
      </div>

      <div class="border-t border-white text-center p-4">
        <p>&copy; 2023, Full Send Disc Golf Inc.</p>
      </div>
    </footer>

    <script src="scripts/scripts.js"></script>
    <script src="../node_modules/flowbite/dist/flowbite.min.js"></script>
  </body>
</html>
HTML;
}

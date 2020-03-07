 <!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Today's artisans</title>
    <link rel="icon" type="/image/png" href="Data/image/icon.png">
		<link rel="stylesheet" href="style.css">
		<link rel="stylesheet" href="style2.css">
    <!-- <link rel="stylesheet" href="//static-rav.leboncoin.fr/app.a04675c733cc033ee8f9.css"> -->
    <?php
    /*
    $connect = 0 => pas de connection
    $connect = 1 => connection en arrière plan
    */
    $nbPage = 0;
    ?>
	</head>
  
	<body>
    <?php
    if (isset($_GET['nbPage'])) {
      $nbPage = intval(htmlentities($_GET['nbPage']));
    } else {
      $nbPage = 0;
    }
    if (isset($_GET['connect'])) {
      $connect = intval(htmlentities($_GET['connect']));
    } else {
      $connect = 0;
    }
    if (isset($_GET['titre']) && isset($_GET['annonce'])) {
      $nomUtilisateur = htmlentities($_GET['nomuser']);
      $dataFile = fopen('./Data/dataFile'.$nomUtilisateur.'.txt', "w");
      file_put_contents($dataFile, htmlentities($_GET['titre']), FILE_APPEND);
    } elseif (isset($_GET['nomUtilisateur'])) {
      $nomUtilisateur = htmlentities($_GET['nomuser']);
      $dataFile = fopen('./Data/dataFile'.$nomUtilisateur.'.txt', "w"); // or die("Unable to open file!");
      file_put_contents($dataFile, htmlentities($_GET['titre']), FILE_APPEND);
    }
     ?>
    <header>
      <div class="">
        <a href="?">
          <img src="/Data/image/icon.png" alt="icon">
      		<h1>Today's artisans</h1>
        </a>
        <nav>
          <ul>
            <a class="home" href="?nbPage=0&amp;<?php echo $connect; ?>"><li>Home Page</li></a>
            <?php if($connect === 1){ ?>
              <a class="client" href="?nbPage=1&amp;<?php echo $connect; ?>"><li>Client Page</li></a>
            <?php } ?>
            <a class="jobs" href="?nbPage=2&amp;<?php echo $connect; ?>"><li>Jobs - Add</li></a>
            <a href="?nbPage=5&amp;<?php echo $connect; ?>"><li><img src="./Data/image/acount.jpg" alt="acount"></li></a>
          </ul>
        </nav>
      </div>
    </header>
    <?php
    if ($nbPage === 0) { ?>
      <section>
        <article class="presentation">
          <h2>Our company :</h2>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        </article>
        <article class="">
          <h2>Are you looking for a job ?</h2>
          <h2>Do you need someone for a job ?</h2>
        </article>
      </section>
      <?php
    } elseif ($nbPage === 1 && $connect === 1) { ?>
      <section>
        <article class="addContract">
          <a href="?nbPage=3&amp;<?php echo $connect; ?>">
            <img src="./Data/image/plus.jpg" alt="un plus">
            <h3>Add a contract</h3>
          </a>
        </article>

        <h2>Not completed contract :</h2>
        <?php
        $nomUtilisateur = 'Tanguy';
        $dataFile = fopen('./Data/dataFile'.$nomUtilisateur.'.txt', "r"); // or die("Unable to open file!");
        $lg = intval(fgets($dataFile));
        for ($i = 0; $i < $lg; ++$i) { ?>
          <article class="jobsCon">
            <h2><?php echo fgets($dataFile); //titre de l'annonce ?></h2>
            <h3>Place : <?php echo fgets($dataFile); ?></h3>
            <div>
              <img src="" alt="./Data/image/<?php echo fgets($dataFile); //source de l'image?>">
              <p>Experiance : <?php echo fgets($dataFile); ?></p>
              <p><?php echo fgets($dataFile); //description de l'annonce ?></p>
            </div>
          </article>
        <?php } ?>

        <h2>Waiting for a review :</h2>
        <article class="contractWainting">
          <img src="" alt="img artisans">
          <ul>
            <li>Mark artisan</li>
            <li>Mark from artisant</li>
          </ul>
        </article>

        <aside class="your info">
          <a href="?nbPage="></a>
        </aside>
      </section>
    <?php
    } elseif ($nbPage === 2) { ?>
      <section class="jobsSec">
        <h2>Announcement : World</h2>
        <?php
        $dataFile = fopen("./Data/dataFile.txt", "r") or die("Unable to open file!");
        $lg = intval(fgets($dataFile)); ?>
        <div>
        <?php for ($i = 0; $i < $lg; $i++) {
          if (trim(fgets($dataFile)) === 'encours'){ ?>
            <article class="jobs">
                <div>
                  <?php $img = trim(fgets($dataFile)); ?>
                  <img src="Data/image/<?php echo $img;?>" type="/image/png" alt="">
                </div>
                <div>
                  <h2><?php echo fgets($dataFile); //titre de l'annonce ?></h2>
                  <h3><span><?php echo fgets($dataFile);//rémunération?> €</span> / hour</h3>
                  <p>Place : <?php echo fgets($dataFile); //lieu de l'annonce ?></p>
                  <p>Experience needed : <?php echo fgets($dataFile); //experiance dem&&é?></p>
                  <p><?php echo fgets($dataFile); //description?></p>
                </div>
            </article><?php
          } else {
            for ($j=0; $j < 6; $j++) {
              fgets($dataFile);
            }
          }
        } ?>
        </div>
        <?php fclose($dataFile); ?>
      </section>
      <?php
    } elseif ($nbPage === 3 ) {// && $connect=2?>
      <h2>Creer une annonce</h2>
      <form class="" action="?" method="get">
        <label for="title">Title of your add :</label>
        <input type="text" name="title" value="Gardenning"><br>
        <label for="where">Where it is :</label>
        <input type="text" name="where" value="Paris"><br>
        <label for="img">Upload a image</label>
        <input type="image" name="img" value="image.jpg"><br>
        <label for="exp">Quel est l'experiance requise pour répondre à votre annonce :</label>
        <input type="number" name="exp" value="1"><br>
        <label for="px">Quel est la rémunération de votre annonce :</label>
        <input type="number" name="px" value="0 €"><br>
        <input class="hide" type="number" name="connect" value="0">
        <input class="hide" type="number" name="nbPage" value="0">
        <input class="hide" type="number" name="addannonce" value="1">
        <input type="submit" value="Connect">
      </form>
    <?php
    } elseif ($nbPage === 5 && $connect === 0) { ?>
      <section>
        <article class="login">
          <h2>You have a account : connect you :</h2>
          <form action="?nbPage=7&amp;connect=1" method="post">
            <label for="lg">Login :</label>
            <input type="text" name="lg" value="yolo"><br><br>
            <label for="pwd">Password :</label>
            <input type="password" name="pwd" value="password"><br><br>
            <input type="submit" value="Connect"><br>
          </form>
        </article>
        <article class="">
          <h3>You haven't het a acount. Create you one :</h3>
          <form action="?nbPage=7&amp;connect=0" method="post">
            <input type="submit" value="Create a new acount"><br>
          </form>
        </article>
      </section>
    <?php
  } elseif ($nbPage === 7 && $connect === 0) { ?>
      <section>
        <article class="">
          <h2>Create a acount</h2>
          <form class="" action="?" method="get">
            <label for="name">Enter your name : </label>
            <input type="text" name="name" value="Signoret"><br>
            <label for="first">Enter your first name : </label>
            <input type="text" name="first" value="Tanguy"><br>
            <label for="first">Enter your adresse : </label>
            <input type="text" name="adresse" value="Voiron"><br>
            <label for="first">Enter your email-adresse : </label>
            <input type="email" name="email" value="tanguy.signoret@gmail.com"><br>
            <label for="first">Enter your phone number : </label>
            <input type="tel" name="number" value="0102030405"><br>
            <input class="hide" type="number" name="connect" value="1">
            <input class="hide" type="number" name="nbPage" value="0">
            <input type="submit" value="Connect">
          </form>
        </article>
      </section>
    <?php
  } elseif ($nbPage === 7 && $connect === 1) { ?>
      <section>
        <article class="our info">
          <h2>Edit your infos :</h2>
          <?php
          //recupération du nom d'utilisateur via $_SESSION
          $nomUtilisateur = 'Tanguy';
          $profileFileUs = fopen('./Data/dataFile'.$nomUtilisateur.'.txt', "r");
          ?>
          <form class="" action="?" method="get">
            <label for="name">Name : </label>
            <input type="text" name="name" value="<?php echo fgets($dataFile); ?>"><br>
            <label for="fn">First name : </label>
            <input type="text" name="fn" value="<?php echo fgets($dataFile); ?>"><br>
            <label for="ad">Adresse : </label>
            <input type="text" name="ad" value="<?php echo fgets($dataFile); ?>"><br>
            <label for="tel">Phone : </label>
            <input type="tel" name="tel" value="<?php echo fgets($dataFile); ?>"><br>
            <label for="mail">Email : </label>
            <input type="email" name="mail" value="<?php echo fgets($dataFile); ?>"><br>
            <input class="hide" type="number" name="connect" value="1">
            <input class="hide" type="number" name="nbPage" value="0">
            <input type="submit" value="Save">
          </form>
          <?php fclose($profileFileUs); ?>
          <form class="" action="?nbPage=0&amp;connect=0" method="get">
            <input type="submit" value="Disconnect">
          </form>
        </article>
      </section>
    <?php } ?>
    <footer>
      <h2>About us :</h2>
      <p>Legals mentions : Today's Artisans Ⓒ Compagny</p>
      <p>Web developper : Tanguy, Thomas, Flavien</p>
    </footer>
	</body>
</html>

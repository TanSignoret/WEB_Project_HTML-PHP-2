 <!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Today's artisans</title>
    <link rel="icon" type="/image/png" href="Data/image/icon.png">
		<link rel="stylesheet" href="style.css">
		<link rel="stylesheet" href="styleHead.css">
    <?php
    session_start();
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
      $_SESSION["nbPage"] = $nbPage;
    } else {
      $_SESSION["nbPage"] = 0;
    }

    if (isset($_GET['connect'])) {
      $connect = intval($_GET['connect']);
      $_SESSION["connect"] = $connect;
    } elseif (!isset($_SESSION["connect"])) {
      $_SESSION["connect"] = 0;
    }

    if (isset($_SESSION['titre']) && isset($_SESSION['annonce'])) {
      $nomUtilisateur = $_SESSION['nomuser'];
      $dataFile = fopen('./Data/dataFile'.$nomUtilisateur.'.txt', "w");
      file_put_contents($dataFile, $_SESSION['titre'], FILE_APPEND);
    }

    if (isset($_GET['titre']) && isset($_GET['where'])) {
      $dataFile = './Data/dataFile.txt';
      $nbAn = intval(file_get_contents($dataFile));
      file_put_contents($dataFile, $nbAn + 1);
      file_put_contents($dataFile, 'encours', FILE_APPEND);
      // fputs()
      file_put_contents($dataFile, '\n', FILE_APPEND);
      file_put_contents($dataFile, 'image1.png', FILE_APPEND);
      file_put_contents($dataFile, '\n', FILE_APPEND);
      file_put_contents($dataFile, $_GET['titre'], FILE_APPEND);
      file_put_contents($dataFile, '\n', FILE_APPEND);
      file_put_contents($dataFile, $_GET['px'], FILE_APPEND);
      file_put_contents($dataFile, '\n', FILE_APPEND);
      file_put_contents($dataFile, $_GET['where'], FILE_APPEND);
      file_put_contents($dataFile, '\n', FILE_APPEND);
      file_put_contents($dataFile, $_GET['exp'], FILE_APPEND);
    }

    if (isset($_GET['name']) && isset($_GET['email'])) {
      $nomUtilisateur = $_GET['name'];
      $_SESSION['nomuser'] = $nomUtilisateur;
      /*probleme dans l'écriture des fichiers*/
      $dataFile = './Data/dataFile'.$nomUtilisateur.'.txt';
      file_put_contents($dataFile, $_GET['name']);
      file_put_contents($dataFile, '\n', FILE_APPEND);
      file_put_contents($dataFile, $_GET['first'], FILE_APPEND);
      file_put_contents($dataFile, '\n', FILE_APPEND);
      file_put_contents($dataFile, $_GET['adresse'], FILE_APPEND);
      file_put_contents($dataFile, '\n', FILE_APPEND);
      file_put_contents($dataFile, $_GET['email'], FILE_APPEND);
      file_put_contents($dataFile, '\n', FILE_APPEND);
      file_put_contents($dataFile, $_GET['number'], FILE_APPEND);
    } elseif (isset($_GET['name'])) {
      $_SESSION['nomuser'] = $_GET['name'];
    }

    $nbPage = $_SESSION["nbPage"];
    $connect = $_SESSION["connect"];

     ?>
    <header>
      <?php
      $connect = intval($_SESSION['connect']);
      ?>
      <div class="">
        <a href="?"<?php $_SESSION["nbPage"] = 0; ?>>
          <!-- <img src="Data/image/todaysArtisans.png" type="/image/png" alt="icon"> -->
          <h1><span>Today's</span><span> Artisans</span></h1>
        </a>
        <nav>
          <ul>
            <a class="home" href="?nbPage=0"<?php $_SESSION["nbPage"] = 0; ?>><li>Home Page</li></a>
            <?php if($connect === 1){ ?>
              <a class="client" href="?nbPage=3"<?php $_SESSION["nbPage"] = 1; ?>><li>Add a contract</li></a>
            <?php } ?>
            <a class="jobs" href="?nbPage=2"<?php $_SESSION["nbPage"] = 2; ?>><li>Jobs - Add</li></a>
            <a href="?nbPage=5"<?php $_SESSION["nbPage"] = 5; ?>><li><img src="./Data/image/acount.jpg" alt="acount"></li></a>
          </ul>
        </nav>
      </div>
    </header>
    <?php

    $connect = intval($_SESSION['connect']);
    // $nbPage = intval($_SESSION['nbPage']);

    if ($nbPage === 0) { ?>
      <section>
        <article class="presentation">
          <h2>Our company :</h2>
          <p>We are a new enterprise looking forward to help all people to show their Artisan skills no matter the age, location or any social distinction. We want this to be a friendly and helpful tool for anyone looking for a work to be done or do a job. Our platform is made inn a way that everyone can have access to it without any complication. This is made in a way that people that doesn't have a great technology knowledge can look for a job or search for a Artisan.</p>
        </article>
        <article class="">
          <h2>Are you looking for a job ?</h2>
          <p>Don't worry, our site is here for people who wants to get a job. Just create an account and look for all the contracts offered, chose the right one for you and it's done!</p>
          <h2>Do you need someone for a job ?</h2>
          <p>All you have to do is create an account and post a contract offer specifying all the information about the job. Next to that, if anybody is interested you will receive a notification that a person has accepted your contract.</p>
        </article>
      </section>
      <?php
    } elseif ($nbPage === 1 && $connect === 1) { ?>
      <section class="addSec">
        <article>
          <a href="?nbPage=3">
            <img src="./Data/image/plus.jpg" alt="un plus">
            <h3>Add a contract</h3>
          </a>
        </article>

        <h2>Not completed contract :</h2>
        <?php
        // $nomUtilisateur = $_SESSION["connect"];
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
          <a href="?"<?php $_SESSION["connect"] = $connect; $_SESSION["nbPage"] = 7; ?>>Your info</a>
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
    } elseif ($nbPage === 3 && $connect === 1 ){?>
      <section class="addSec">
        <h2>Create a contract</h2>
        <form class="" action="?" method="get">
          <label for="title">Title of your add :</label>
          <input type="text" name="title" value="Gardenning"><br>
          <label for="where">Where it is :</label>
          <input type="text" name="where" value="Paris"><br>
          <label for="img">Upload a image :</label>
          <input type="file" name="img" value="image.jpg"><br>
          <label for="exp">Wath is the experiance needed for your add :</label>
          <input type="number" name="exp" value="1"><br>
          <label for="px">Remuneration by hour :</label>
          <input type="number" name="px" value="5"><br>
          <input class="hide" type="number" name="connect" value="1">
          <input class="hide" type="number" name="nbPage" value="3">
          <input type="submit" value="Create">
        </form>
      </section>
    <?php
    } elseif ($nbPage === 5 && $connect === 0) { ?>
      <section class="login">
        <article>
          <h2>You have a account : connect you :</h2>
          <form action="?" method="get">
            <label for="name">Login :</label>
            <input type="text" name="name" value="yolo"><br><br>
            <label for="pwd">Password :</label>
            <input type="password" name="pwd" value="password"><br><br>
            <input class="hide" type="number" name="nbPage" value="0">
            <input class="hide" type="number" name="connect" value="1">
            <input type="submit" value="Connect"><br>
            <!-- <?php $_SESSION['connect'] = 1 ?> -->
          </form>
        </article>
        <article class="">
          <h2>You haven't het a account. Create you one :</h2>
          <form action="?" method="get">
            <input class="hide" type="number" name="nbPage" value="7">
            <input class="hide" type="number" name="connect" value="0">
            <input type="submit" value="Create a new account"><br>
            <!-- <?php $_SESSION['connect'] = 0 ?> -->
          </form>
        </article>
      </section>
    <?php
  } elseif ($nbPage === 7 && $connect === 0) { ?>
      <section>
        <article class="createSec">
          <h2>Create a account</h2>
          <form class="" action="?" method="get">
            <label for="name">Enter your name : </label>
            <input type="text" name="name" value="Name"><br>
            <label for="first">Enter your first name : </label>
            <input type="text" name="first" value="First name"><br>
            <label for="first">Enter your adresse : </label>
            <input type="text" name="adresse" value="Adresse"><br>
            <label for="first">Enter your email-adresse : </label>
            <input type="email" name="email" value="someone@gmail.com"><br>
            <label for="first">Enter your phone number : </label>
            <input type="tel" name="number" value="010203040506"><br>
            <label for="pwd">Enter your password :</label>
            <input type="password" name="pwd" value="password"><br>
            <input class="hide" type="number" name="nbPage" value="0">
            <input class="hide" type="number" name="connect" value="1">
            <input type="submit" value="Create" <?php $_SESSION['connect'] = 1 ?>>
          </form>
          <form class="" action="?" method="get">
            <input class="hide" type="number" name="nbPage" value="0">
            <input class="hide" type="number" name="connect" value="0">
            <input type="submit" value="Cancel" <?php $_SESSION['connect'] = 0 ?>>
          </form>
        </article>
      </section>
    <?php
  } elseif ($nbPage === 5 && $connect === 1) { ?>
      <section>
        <article class="ourInfo">
          <h2>Edit your infos :</h2>
          <?php
          $_SESSION['connect'] = 1;
          //recupération du nom d'utilisateur via $_SESSION
          $nomUtilisateur = $_SESSION['nomuser'];
          $profileFileUs = fopen('./Data/dataFile'.$nomUtilisateur.'.txt', "r");
          ?>
          <form class="" action="?" method="get">
            <label for="name">Name : </label>
            <?php $var = fgets($profileFileUs); ?>
            <input type="text" name="name" value="<?php echo $var ?>"><br>
            <label for="fn">First name : </label>
            <?php $var = fgets($profileFileUs); ?>
            <input type="text" name="fn" value="<?php echo $var ?>"><br>
            <label for="ad">Adresse : </label>
            <?php $var = fgets($profileFileUs); ?>
            <input type="text" name="ad" value="<?php echo $var ?>"><br>
            <label for="tel">Phone : </label>
            <?php $var = fgets($profileFileUs); ?>
            <input type="tel" name="tel" value="<?php echo $var ?>"><br>
            <label for="mail">Email : </label>
            <?php $var = fgets($profileFileUs); ?>
            <input type="email" name="mail" value="<?php echo $var ?>"><br>
            <input class="hide" type="number" name="nbPage" value="0">
            <input class="hide" type="number" name="connect" value="1">
            <input type="submit" value="Save">
          </form>
        </article>
        <?php fclose($profileFileUs); ?>
        <article class="ourInfo">
          <h2>Do you want to log out ?</h2>
          <form class="" action="?" method="get">
            <input class="hide" type="number" name="nbPage" value="0">
            <input class="hide" type="number" name="connect" value="0">
            <input type="submit" value="Disconnect">
          </form>
        </article>
      </section>
    <?php } ?>
    <footer>
      <h2>About us :</h2>
      <p>Legals mentions : Today's Artisans Ⓒ Compagny  -  Web developpers : Tanguy, Thomas, Flavien</p>
    </footer>
	</body>
</html>

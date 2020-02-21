 <!DOCTYPE html>
<html>
	<head>
		<title>Today's artisans - Jobs</title>
		<meta name="" content="">
		<link rel="stylesheet" href="style.css">
		<link rel="stylesheet" href="style2.css">
    <?php
    $nbPage = 0;
    $nbPage = 1;
    ?>
	</head>
	<body>
    <?php
    $nbPage = $_GET['nbPage'];
     ?>
    <header>
  		<h1>Today's artisans</h1>
      <a href="countPage.html"><img src="./Data/image/acount.jpg" alt="acount"></a>
    </header>

    <nav>
      <ul>
        <li><a class="home" href="?nbPage=0">Home Page</a></li>
        <li><a class="client" href="?nbPage=1">Client Page</a></li>
        <li><a class="jobs" href="?nbPage=2">Jobs - Artisans</a></li>
      </ul>
    </nav>
    <?php
    if ($nbPage == 0) { ?>
      <section>
        <article class="presentation">
          <h2>Our compagny :</h2>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        </article>
        <article class="">
          <h3>Are you looking for a job ?</h3>
          <h3>Do you need someone for a job ?</h3>
        </article>
      </section>
      <?php
    } elseif ($nbPage == 1) { ?>
      <section>
        <article class="addContract">
          <a href="?nbPage=3">
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
          <article class="jobs">
            <h3><?php echo fgets($dataFile); //titre de l'annonce ?></h3>
            <h2>Lieu : <?php echo fgets($dataFile) ?></h2>
            <div>
              <img src="" alt="./Data/image/<?php echo fgets($dataFile); //source de l'image?>">
              <p>experiance : <?php echo fgets($dataFile) ?></p>
              <p><?php echo fgets($dataFile); //description de l'annonce ?></p>
            </div>
          </article>
        <?php } ?>

        <h2>Waiting for a review :</h2>
        <article class="contractWainting">
          <img src="" alt="img artisans">
          <ul>
            <li>note à artisant</li>
            <li>"note de l'artisant"</li>
          </ul>
        </article>

        <aside class="your info">
          <h3>Your info :</h3>
          <ul>
            <li>Nom :</li>
            <li>Prenom :</li>
            <li>Adresse :</li>
            <li>Tel :</li>
            <li>Email :</li>
            <li>Notes :</li>
          </ul>
        </aside>
      </section>
    <?php
    }
    elseif ($nbPage == 2) { ?>
      <section class="jobs">
        <h2>Annonces en Rhones - Alpes</h2>
        <?php
        $dataFile = fopen("./Data/dataFile.txt", "r") or die("Unable to open file!");
        // file_put_contents($dataFile, $current, FILE_APPEND);
        $lg = intval(fgets($dataFile));
        for ($i = 1; $i < $lg; $i++) { ?>
          <article class="jobs">
            <h3><?php echo fgets($dataFile); //titre de l'annonce ?></h3>
            <div>
              <img src="" alt="./Data/image/<?php echo fgets($dataFile); //source de l'image?>">
              <p><?php echo fgets($dataFile); //description de l'annonce ?></p>
            </div>
          </article>
          <?php
        }
        fclose($dataFile);
        ?>
      </section>
      <?php
    } elseif ($nbPage=3 and $connect=1) { ?>
      <h2>Creer une annonce</h2>
      <form class="" action="page.php>" method="get">
        <label for="titre">Quel est le nom de votre annonce :</label>
        <input type="text" name="titre" value="Jardinage">
        <label for="lieu">Quel est le lieu de votre annonce :</label>
        <input type="text" name="lieu" value="Paris">
      </form>
    }
    ?>

    <footer>
      <h2>About us :</h2>
      <p>Legals mentions : ...</p>
    </footer>
	</body>
</html>

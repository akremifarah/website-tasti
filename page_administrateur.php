<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="page_administrateur.css">
  <title>Admin Panel</title>
</head>
<body>
  <header>
    <h1>Bienvenue sur le panel d'administration!</h1>
  </header>
  <nav>
    <ul>
      <li><a href="page_administrateur.php">administrateur</a></li>
      
      
    </ul>
  </nav>
  <main>
    
    <section>
      <h2>Les derniers comptes crées des administrateurs !</h2>
      <?php
      try {
        $pdo = new PDO('mysql:host=localhost;dbname=TASTI', 'root', 'manager', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    } catch (PDOException $e) {
        
        echo 'Erreur : ' . $e->getMessage();
        die();
    }
      $strategies=$pdo->query('SELECT * FROM admin')->fetchall(PDO::FETCH_OBJ);
      ?>
      <table class="table-striped">
        <thead>
          <tr>
          <th>idadmin</th>
          <th>nom</th>
            <th>prenom</th>
            <th>mdp</th>
            <th>tlph</th>
         </tr>
       </thead>
       <tbody>
       <?php foreach ($strategies as $login_adm) : ?>
        <tr>
        <td><?= $login_adm->cin?></td>
        <td><?= $login_adm->nom?></td>
          <td><?= $login_adm->prenom?></td>
          <td><?= $login_adm->mdp?></td>
          <td><?= $login_adm->tlph?></td>
       </tr>
       <?php endforeach ; ?>
       </tbody>
       </table>
    </section>
    
    <section>
      <h2>les derniers comptes crees des clients</h2>
      <?php
      try {
        $pda = new PDO('mysql:host=localhost;dbname=TASTI', 'root', 'manager', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    } catch (PDOException $e) {
        
        echo 'Erreur : ' . $e->getMessage();
        die();
    }
      $strategie=$pda->query('SELECT * FROM client')->fetchall(PDO::FETCH_OBJ);
      ?>
      <table class="table-striped">
        <thead>
          <tr>
          <th>nom</th>
            <th>prenom</th>
            <th>mdp</th>
            <th>tlph</th>
         </tr>
       </thead>
       <tbody>
       <?php foreach ($strategie as $client) : ?>
        <tr>
          <td><?= $client->nom?></td>
          <td><?= $client->prenom?></td>
          <td><?= $client->mdp?></td>
          <td><?= $client->tlph?></td>
       </tr>
       <?php endforeach ; ?>
       </tbody>
       </table>
    </section>
  </main>
</body>
</html>

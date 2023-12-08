<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tugma</title>
  <link rel="stylesheet" href="../style/main.css">
  <link rel="stylesheet" href="../style/carousel.css">
  
</head>

<body>
  <nav class="nav-container">
    <div class="logo-container">
      <a href="?" class="logo">Tugma</a>
    </div>
    <div class="right-nav-container">
     
      <span class="menu-button">
        <ion-icon name="grid-outline"></ion-icon>
      </span>
      <ul class="menus">
        <li><a id="log-in-button" href="#">log in</a></li>
        <li><a id="sign-up-button" href="#">sign up</a></li>
      </ul>
    </div>
</nav>

<form class="sign-container" id="signup" data-signup-shown="false" action="../logic/signup.php" method="post">
  <h1>Sign Up</h1>
  <div>
    <input name="email" type="text" id="email" autocomplete="on" required>
    <span>Email:</span>
  </div>
  <div>
    <input name="displayName" type="text" id="displayName" autocomplete="off"  required>
    <span>Display Name:</span>
  </div>
  <div>
    <span id="availability" style="position: relative;"></span>
    <input name="username" type="text" id="username" autocomplete="on"  required pattern="^[a-zA-Z0-9_]+$">
    <span>Username:</span>
    <span id="availability"></span>
  </div>
  <div>
    <input name="password" type="password" id="password" required>
    <span>Password:</span>
  </div>
  <button type="submit">Sign up</button>
</form>


<form class="sign-container" id="login" data-signin-shown="false" action="../logic/login.php" method="post">
  <h1>Log In</h1>
  <div>
    <input type="text" required name="username" id="username" autocomplete="on" >
    <span>Username:</span>
  </div>
  <div>
    <input type="password" required name="password" autocomplete="on">
    <span>Password:</span>
  </div>
  
  <button>Log in</button>
</form>
<main class="body-container">

<div class="text-container">
  
  <h1>Introducing "<span class="text-title">Tugma</span>"</h1>
  <h3>- Your Gateway to Local Music Collaboration and Discovery</h3>
  <p>In a world that is increasingly interconnected, music remains a universal language that transcends boundaries and brings people together. "Tugma," our revolutionary music website project, is set to transform the way local artists and producers collaborate and share their musical creations, offering them an innovative platform to upload their music and providing eager listeners with a treasure trove of talent to disco</p>
</div>
<img src="../img/TUGMA.png" alt="" style="width: 600px; height: 400px;">
</main>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
<script src="../script/validation.js"></script>
<script src="../script/menu.js"></script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
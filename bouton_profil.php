<ul class="">
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle text-white" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <button type="button" name="button" class="btn btn-secondary"><span class="mr-2 d-none d-lg-inline text-white extra-large float-right"><i class="fas fa-user-circle"></i> <?php echo $_SESSION['nom_prenom']; ?></span></button>
    </a>
    <!-- Dropdown - User Information -->
    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
      <a class="dropdown-item" href="mon_profil.php">
        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
        Mon profil
      </a>
      <a class="dropdown-item" href="changement_mot_de_passe.php">
        <i class="fas fa-key fa-sm fa-fw mr-2 text-gray-400"></i>
        Modifier mon mot de passe
      </a>
      <div class="dropdown-divider"></div>
      <a class="dropdown-item" href="deconnexion.php">
        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
        Se déconnecter
      </a>
    </div>
  </li>
</ul>
<?php
  require 'classes/person.php';
  require 'classes/session.php';
  $user = new person();
  $user->signOut();
  header("location:login.php");


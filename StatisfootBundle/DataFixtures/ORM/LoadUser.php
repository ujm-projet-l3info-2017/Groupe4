<?php
// src/Projet/StatisfootBundle/DataFixtures/ORM/LoadUser.php

namespace Projet\StatisfootBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Projet\StatisfootBundle\Entity\manager;

class LoadUser implements FixtureInterface
{
  public function load(ObjectManager $manager)
  {
    // Les noms d'utilisateurs à créer
    $listNames = array('Alexandre', 'Marine', 'Anna');

    foreach ($listNames as $name) {
      // On crée l'utilisateur
      $user = new manager;

      // Le nom d'utilisateur et le mot de passe sont identiques pour l'instant
      $user->setNomManag('Nom'.$name);
      $user->setPrenomManag('Prenom'.$name);
      $user->setEmail('Email'.$name);
      $user->setUsername($name);
      $user->setPassword($name);
      $user->setNumTel('0669965325');

      // On ne se sert pas du sel pour l'instant
      $user->setSalt('');
      // On définit uniquement le role ROLE_USER qui est le role de base
      $user->setRoles(array('ROLE_MANAGER'));

      // On le persiste
      $manager->persist($user);
    }

    // On déclenche l'enregistrement
    $manager->flush();
  }
}
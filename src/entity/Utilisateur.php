<?php

namespace App\entity;
use App\core\abstract\AbstractEntity;

class Utilisateur extends AbstractEntity
{
    private int $id;
    private string $nom;
    private string $prenom;
    private string $login;
    private string $password;
    private string $numeroCarteIdentite;
    private string $photoRecto;
    private string $photoVerso;
    private Profil $profil;
    private array $comptes;

    public function __construct(int $id=0, string $nom='', string $prenom='', string $login='', string $password='', int $numeroCarteIdentite=0, string $photoRecto='', string $photoVerso='', Profil $profil = new Profil(), array $comptes = []) {
        $this->id = $id;
        $this->nom = $nom;
        $this->login = $login;
        $this->prenom = $prenom;
        $this->password = $password;
        $this->numerocarteIdentite = $numeroCarteIdentite;
        $this->photoRecto = $photoRecto;
        $this->photoVerso = $photoVerso;
        $this->profil = $profil;
        $this->comptes = [];
    }

    public function getId(): int {
        return $this->id;
    }

    public function setId(int $id): bool {
        $this->id = $id;
        return true;
    }

    public function getNom(): string {
        return $this->nom;
    }

    public function setNom(string $nom): bool {
        $this->nom = $nom;
        return true;
    }

    public function getPrenom(): string {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): bool {
        $this->prenom = $prenom;
        return true;
    }

    public function getLogin(): string {
        return $this->login;
    }

    public function setLogin(string $login): bool {
        $this->login = $login;
        return true;
    }
    public function getPassword(): string {
        return $this->password;
    }

    public function setPassword(string $password): bool {
        $this->password = $password;
        return true;
    }

    public function getNumerocarteIdentite(): int {
        return $this->numeroCarteIdentite;
    }

    public function setNumerocarteIdentite(string $numerocarteIdentite): bool {
        $this->numeroCarteIdentite = $numerocarteIdentite;
        return true;
    }

    public function getPhotoRecto(): string {
        return $this->photoRecto;
    }

    public function setPhotoRecto(string $photo): bool {
        $this->photoRecto = $photo;
        return true;
    }

    public function getPhotoVerso(): string {
        return $this->photoVerso;
    }

    public function setPhotoVerso(string $photo): bool {
        $this->photoVerso = $photo;
        return true;
    }

    public function getProfil(): Profil {
        return $this->profil;
    }

    public function setProfil(Profil $profil): bool {
        $this->profil = $profil;
        return true;
    }
    public function getComptes(): array {
        return $this->comptes;
    }

    public function addCompte(Compte $compte): bool {
        $this->comptes[] = $compte;
        return true;
    }

    public function toArray(): array {
        return [
            'id' => $this->id,
            'nom' => $this->nom,
            'prenom' => $this->prenom,
            'login' => $this->login,
            'password' => $this->password,
            'numerocarteidentite' => $this->numeroCarteIdentite,
            'photorecto' => $this->photoRecto,
            'photoverso' => $this->photoVerso,
            'profil' => $this->profil->toArray(),
            'comptes' => array_map(fn($item) => $item->toArray(), $this->comptes)
        ];
    }

    public static function toObject(array $data): static {
        $object = new static();
        $object->setId($data['id']);
        $object->setNom($data['nom']);
        $object->setPrenom($data['prenom']);
        $object->setLogin($data['login']);
        $object->setPassword($data['password']);
        $object->setNumerocarteIdentite($data['numerocarteidentite']);
        $object->setPhotoRecto($data['photorecto']);
        $object->setPhotoVerso($data['photoverso']);
        // $object->setComptes(array_map(fn($item) => Compte::toObject($item), $data['comptes']));
        return $object;
    }

}
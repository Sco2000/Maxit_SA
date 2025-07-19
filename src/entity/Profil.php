<?php

namespace App\entity;
use App\core\abstract\AbstractEntity;


class Profil extends AbstractEntity
{
    private int $id;
    private string $nomProfil;

    public function __construct(int $id=0, string $nomProfil='') {
        $this->id = $id;
        $this->nomProfil = $nomProfil;
    }

    public function getId(): int {
        return $this->id;
    }

    public function setId(int $id): bool {
        $this->id = $id;
        return true;
    }

    public function getNomProfil(): string {
        return $this->nomProfil;
    }

        public function setNomProfil(string $nomProfil): bool {
        $this->nomProfil = $nomProfil;
        return true;
    }

    public static function toObject(array $data): static {
        return new static(
            $data['id'],
            $data['nomProfil']
        );
    }

    public function toArray(): array {
        return [
            'id' => $this->id,
            'nomProfil' => $this->nomProfil
        ];
    }


}
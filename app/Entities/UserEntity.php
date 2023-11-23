<?php

namespace App\Entities;

use CodeIgniter\Shield\Entities\User as ShieldUser;
use CodeIgniter\Entity\Entity;

class UserEntity extends ShieldUser
{
    protected $casts = [
        'id'          => '?integer',
        'active'      => 'int_bool',
        'permissions' => 'array',
        'groups'      => 'array',
        'image'       => 'string',
    ];

    public function getImage(): ?string
    {
        if($this->attributes['image'] === null) {
            return null;
        } else if(strpos($this->attributes['image'], 'http') === 0) {
            return $this->attributes['image'];
        } else {
            return site_url('images/' . $this->attributes['image']);
        }
    }

    public function setImage(string $img)
    {
        $this->attributes['image'] = $img;

        return $this;
    }
}

<?php

namespace App\Traits;

trait AvatarTrait
{
    public function generateAvatar($name,  $size = 100): string
    {
        $length = 1;
        return "https://ui-avatars.com/api/?name={$name}&length={$length}&rounded=true&background=random&color=fff&size={$size}";
    }
}

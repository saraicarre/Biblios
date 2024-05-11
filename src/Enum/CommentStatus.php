<?php

namespace App\Enum;

enum CommentStatus: string
{
    case Pending = 'pending';
    case Published = 'published';
    case Moderated = 'moderated';

    public function getLabel(): string
    {
        return match ($this) {
            self::Pending => 'En attente',
            self::Published => 'Publié',
            self::Moderated => 'Modéré',
        };
    }
}

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */


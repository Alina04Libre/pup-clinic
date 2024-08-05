<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Maintenance extends Model
{
    use HasFactory;
    protected $table = 'maintenances';
    protected $fillable = ['title', 'key', 'list'];

    public function getZoomLink()
    {
        // Retrieve the Zoom link from the JSON data in the Appointment model
        $list = json_decode($this->list, true);

        if (is_array($list) && array_key_exists('zoom_link', $list)) {
            return $list['zoom_link']; // Return the Zoom link
        }

        return null; // Return null if the 'zoom_link' key is not found
    }

    // public function getZoomLink()
    // {
    //     $list = json_decode($this->list, true);

    //     if (is_array($list)) {
    //         return $list; // Return the entire JSON list
    //     }

    //     return null; // Return null if the JSON data is not an array
    // }
}

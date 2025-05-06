<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'category',
        'technologies',
        'status',
        'thumbnail',
        'screenshots',
        'url',
        'preview_path',
    ];

    // Get technologies as array
    public function getTechnologiesArrayAttribute()
    {
        return json_decode($this->technologies, true) ?: [];
    }

    // Get screenshots as array
    public function getScreenshotsArrayAttribute()
    {
        return json_decode($this->screenshots, true) ?: [];
    }

    // Status helpers
    public function getIsOnlineAttribute()
    {
        return $this->status === 'online';
    }

    public function getIsOfflineAttribute()
    {
        return $this->status === 'offline';
    }
    
    public function getIsTemplateAttribute()
    {
        return $this->status === 'template';
    }
    
    // Check if the project has a preview
    public function getHasPreviewAttribute()
    {
        return !empty($this->preview_path);
    }
}
<?php

namespace App\Traits;

use App\Models\Like;

trait Likeable
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function likes()
    {
        return $this->morphMany(Like::class, 'model');
    }

    /*
     * This function is responsible for adding likes
     */
    public function addLike()
    {
        if (!$this->likes()->where('ip', request()->ip())->count()) {
            $this->likes()->create([
                'ip' => request()->ip(),
                'hostname' => request()->getHost(),
                'user_id' => auth()->check() ? auth()->user()->id : null
            ]);

            if(!$this->saveToOwnTable()){
                return;
            }

            $this->{$this->likesTableName()} = $this->likes()->count();
            $this->save();
        }
    }

    /*
     * This function is responsible for checking if a user liked an article before
     */
    public function hasLiked($ip = null)
    {
        return $this->likes()->where('ip', $ip ? $ip : request()->ip())->count(['ip']) ? true : false;
    }

    protected function saveToOwnTable()
    {
        return property_exists($this, 'likeSettings') ? $this->likeSettings['saveToOwnTable'] : false;
    }

    protected function likesTableName()
    {
        return property_exists($this, 'likeSettings') ? $this->likeSettings['likesTableName'] : 'likes';
    }

}
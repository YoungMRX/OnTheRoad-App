<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


/**
 * Class Question
 * @package App
 */
class Question extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['title','body','user_id'];
    //

    /**
     *
     */
    public function isHidden ()
    {
        //return $this->is_hidden === 'T';//T=true,F=false
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function topics ()
    {

        return $this->belongsToMany(Topic::class)->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user ()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopePublished ($query)
    {
        return $query->where('is_hidden','F');
    }


    //Answers

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function answers ()
    {
        return $this->hasMany(Answer::class);
    }

    public function  followers()
    {
        return $this->belongsToMany(User::class,'user_question')->withTimestamps();
    }


    public function comments ()
    {
        return $this->morphMany('App\Comment','commentable');
    }
}

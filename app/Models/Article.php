<?php

namespace App\Models;

use App\Traits\HasAuthor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory, HasAuthor;

    protected $table = "articles";
    protected $fillable = ["title", "slug", "body", "author_id", "image", "created_at", "updated_at"];

    public function id(): string
    {
        return (string) $this->id;
    }
    public function title(): string
    {
        return (string) $this->title;
    }
    public function slug(): string
    {
        return (string) $this->slug;
    }
    public function body(): string
    {
        return (string) $this->body;
    }
    public function image(): string
    {
        return (string) $this->image;
    }
}

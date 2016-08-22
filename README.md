# LaraLike
This repository makes it possible to make any model like-able. 

For instance, if you want your blog items to be liked, you can include the model and trait, and your set.

# Usage

## Installation

Move the following files to these directories:

```
Models/Like.php -> App/Models/Like.php
Traits/Likeable.php -> App/Traits/Likeable.php
Migrations/2016_08_20_114506_create_likes_table.php -> database/migrations/2016_08_20_114506_create_likes_table.php
```

Now run `composer dump-autoload -o` and `php artisan migrate`

## Usage

Add the 'Likeable' trait to your model:

```
use Likeable

Also apply the use at the top of the file:

use App\Traits\Likeable;
```

## Settings

There are currently 2 settings:

```
protected $likeSettings = [
    'saveToOwnTable' => true,
    'likesTableName' => 'likes'
];
```

You can set the likes to be saved as an integer to your model itself, you will have to add a 'likes' row to your models table.
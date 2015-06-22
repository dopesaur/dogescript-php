# dogescript PHP

![doge](./doge.jpg)

dogescript-php is a slightly modified PHP port of [dogescript](https://github.com/dogescript/dogescript), so now you can write dogescript for PHP.

## Language modifications and features

### `so` and start of the block

For the sake of easier parsing, every block statement requires construction `so` to be placed after any doge-construction:

```dogescript
shh if/else statement
rly $doge totally 'so doge' so
    plz echo with $doge
wow
but so
    plz echo with 'not so doge'
wow

shh function definition
such test much $parameters so
    wow $parameters
```

So now, `so` and `wow` acting like a `{`, and `}`.

#### `so` module

In dogescript's language specs, `so` is stands for JS module require, but in dogescript-php it's replaced for PHP's `use` statement (importing classes), so this:

```dogescript
so PDO
```

Becomes this:

```php
use PDO;
```

You can also create alias with `as` for specific class:

```dogescript
so PDO as DogePDO
```

And PHP:

```php
use PDO as DogePDO;
```

### totally, noway, is, isnt, and not

In original dogescript, there was only `is` and `not` for boolean comparison (`===` and `!==`), but here you've got also `totally`, `noway`, and `isn't`, basically:

* `totally` - `===`
* `noway` - `!==`
* `is` - `==`
* `isnt` - `!=`
* `not` - `!`

### foreach, i did it 4 lulz

The keyword `4lulz` is a foreach. I'm not entirely sure about using `4lulz` as foreach, I think for foreach following keywords can be used:

* `4each`
* `4chan`
* `4ich`
* `each`
* `every`

Leave me a comment, in case if you have more options.

Syntax of `4lulz`:

```
4lulz $key_or_value [$value] with $array so
    shh body of foreach
wow
```

Example:

```dogescript
4lulz $value with $array so
    plz echo with "$value\n"
wow

4lulz $key $value with $array so
    plz echo with $key $value
wow
```

And this code converted to PHP:

```php
foreach ($array as $value) {
    echo($value);
}

foreach ($array as $key => $value) {
    echo($key, $value);
}
```
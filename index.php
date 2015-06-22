<?php require 'vendor/autoload.php';

$file = $_SERVER['argv'][1];

echo $file;

if (file_exists($file)) {
    $code = Doge\Such::script($file);
    $file = substr($file, 0, strrpos($file, '.'));
    
    file_put_contents("$file.php", "<?php\n\n$code");
}
else {
    echo "Such file '$file', so not exists";
}

<header class="bg-primary py-5 mb-5 " style="background-image: url('<?php


if(file_exists($Source.$HeadingImage)&&($HeadingImage!=""))
{
    $HeadingImage=$Source.$HeadingImage;

}
else {
    $HeadingImage = 'https://st2.depositphotos.com/3336339/11976/i/950/depositphotos_119763698-stock-photo-abstract-futuristic-hall-background.jpg';
}


echo $HeadingImage?>');
            width: 100%;
            height: auto;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;">
    <div class="container h-100" >
        <div class="row h-100 align-items-center">
            <div class="col-lg-12 transparencyjumbo">
                <h2 class="mt-5 mb-2"><?php echo $HeadingName; ?></h2>
                <p class="lead mb-5 text-white-50">.</p>
            </div>
        </div>
    </div>
</header>
<?php
if(isset($pageName))
{
    echo '
<div class="container">
    <h2 align="center" class="text-muted">'.$pageName.'</h2>
    <hr>
</div>';

}
?>


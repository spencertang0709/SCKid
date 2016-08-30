<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/*
* User and related entites
*/
$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

//Admin factory
$factory->defineAs(App\User::class, 'admin', function () {
    return [
        'name' => 'admin',
        'email' => 'admin@example.com',
        'password' => bcrypt('123456'),
        'remember_token' => str_random(10),
    ];
});

$factory->defineAs(App\User::class, 'parent', function () {
    return [
        'name' => 'Parent1',
        'email' => 'parent@example.com',
        'password' => bcrypt('123456'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Role::class, function (Faker\Generator $faker) {
    return [
        'id' => $faker->randomElements(array('1','2','3'))
    ];
});

/*
* Kid and related entities
*/
$factory->define(App\Kid::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->firstName,
        'age' => $faker->numberBetween(3,19),
        'address' => $faker->address,
        'private' => $faker->realText(10),
    ];
});

//One-Many
$factory->define(App\Call::class, function (Faker\Generator $faker) {
    // Random datetime of the current week
    $startDate = $faker->dateTimeBetween('this week', '+6 days');
    // Random datetime of the current week *after* `$startingDate`
    $endDate   = $faker->dateTimeBetween($startDate, strtotime('+6 days'));

    return [
        'number' => $faker->phoneNumber,
        'contact' => $faker->firstName,
        'direction' => $faker->boolean(50),
        'start_time' => $startDate,
        'end_time' => $endDate,
    ];
});

$factory->define(App\ContextPolicy::class, function (Faker\Generator $faker) {
    return [
        'app_list' => $faker->realText(10),
        'start_time' => $faker->dateTime,
        'end_time' => $faker->dateTime,
        'screen_time' => $faker->boolean,
    ];
});

$factory->define(App\Device::class, function (Faker\Generator $faker) {

    $models = array('Samsung','Nokia','Huawei','Sony','LG','Lenovo','HTC');

    return [
        'name' => $faker->name,
        'model' => $faker->randomElement($models),
        'unique_id' => $faker->uuid,
    ];
});

$factory->defineAs(App\Device::class, 'device', function () {
    return [
        'name' => 'CATEST',
        'model' => 'CATEST',
        'unique_id' => '1234',
    ];
});


$factory->define(App\Location::class, function (Faker\Generator $faker) {
    return [
        //New Zealand
        'latitude' => $faker->randomFloat(null,-47,-33),
        'longitude' => $faker->randomFloat(null,164, 179),
        'time' => $faker->dateTimeBetween('this week', '+6 days'),
    ];
});

$factory->define(App\Panic::class, function (Faker\Generator $faker) {
    return [
        'latitude' => $faker->latitude,
        'longitude' => $faker->longitude,
        'time' => $faker->dateTime,
        'message' => $faker->realText(90),
    ];
});

$factory->define(App\Sms::class, function (Faker\Generator $faker) {
    // Random datetime of the current week
    $smsDate = $faker->dateTimeBetween('this week', '+6 days');

    return [
        'title' => $faker->realText(10),
        'contact' => $faker->firstName,
        'direction' => $faker->boolean,
        'read' => $faker->boolean,
        'message' =>$faker->realText(20),
        'time' => $smsDate,
    ];
});

//Many-Many with extra attributes on the relationship
$factory->define(App\App::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'package' => $faker->tld.($faker->domainName),
    ];
});

$factory->define(App\SocialMedia::class, function (Faker\Generator $faker) {
    return [
        'type' => $faker->randomLetter,
    ];
});

$factory->define(App\LikedPage::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->realText(6),
    ];
});

$factory->define(App\Post::class, function (Faker\Generator $faker) {
    return [
        'message' => $faker->realText(20),
        'comments' => $faker->realText(10),
        'likes' => $faker->numberBetween(0, 50),
        'post_time' => $faker->dateTime,
        'story' => $faker->realText(5),
        'location' => $faker->city,
        'major' => $faker->numberBetween(1000,99999),
        'minor' => $faker->numberBetween(1000,99999),
    ];
});

$factory->define(App\Album::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'comments' => $faker->realText(10),
        'count' => $faker->numberBetween(1, 100),
        'privacy' => $faker->realText(5),
    ];
});

$factory->define(App\Photo::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->realText(8),
        'source' => $faker->domainName,
    ];
});

$factory->define(App\Website::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->domainWord,
        'host' => $faker->domainName,
        'ip' => $faker->ipv4,
        //'ipv6' => $faker->ipv6,
        'type' => $faker->randomLetter,
    ];
});

//Many-Many
$factory->define(App\Beacon::class, function (Faker\Generator $faker) {
    return [
        'location' => $faker->city,
        'major' => $faker->numberBetween(1000,99999),
        'minor' => $faker->numberBetween(1000,99999),
    ];
});

$factory->define(App\Category::class,function(Faker\Generator $faker){
    return[
        'name'=>$faker->realText(20),
    ];
});

$factory->define(App\Title::class,function(Faker\Generator $faker){
    return[
        'name'=>$faker->realText(20),
    ];
});

$factory->define(App\Article::class,function(Faker\Generator $faker){
    return[
        'subheading'=>$faker->realText(30),
        'content'=>$faker->realText(1024)
    ];
});

$factory->define(App\VerificationCode::class,function(Faker\Generator $faker){
    return[
        'value' => $faker->realText(10),
        'created_time' => $faker->dateTime
    ];
});

/*
$factory->define(App\TimeSlot::class, function (Faker\Generator $faker) {
return [
'date' => $faker->date,
'day' => $faker->date->today,
'start_time' => $faker->dateTime,
'end_time' => $faker->dateTime,
];
});
*/

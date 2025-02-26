<?php

use App\Models\Permission;
use League\Csv\Writer;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

function timeFormat()
{
    return 'Y-m-d H:i:s';
}
function admin()
{
    return auth()->guard('admin')->user();
}
function user()
{
    return auth()->guard('web')->user();
}
function institute()
{
    return auth()->guard('institute')->user();
}
function creater_name($user)
{
    return $user->name ?? 'System';
}

function updater_name($user)
{
    return $user->name ?? 'Null';
}
function slugToTitle($slug)
{
    return Str::replace('-', ' ', $slug);
}
function storage_url($urlOrArray)
{
    $image = asset('default_img/no_img.jpg');
    if (is_array($urlOrArray) || is_object($urlOrArray)) {
        $result = '';
        $count = 0;
        $itemCount = count($urlOrArray);
        foreach ($urlOrArray as $index => $url) {
            if (Str::contains($url, ['http://', 'https://'])) {
                $result .= $url;
                continue;
            }

            $result .= $url ? asset('storage/' . $url) : $image;

            if ($count === $itemCount - 1) {
                $result .= '';
            } else {
                $result .= ', ';
            }
            $count++;
        }
        return $result;
    } else {
        if (Str::contains($urlOrArray, ['http://', 'https://'])) {
            return $urlOrArray;
        }
        return $urlOrArray ? asset('storage/' . $urlOrArray) : $image;

    }
}

function auth_storage_url($url, $model = null)
{
    if (Str::contains($url, ['http://', 'https://'])) {
        return $url;
    }
    $image = asset('default_img/user.png');
    // if ($model->gender == $model::GENDER_MALE) {
    //     $image = asset('default_img/male-1.jpeg');
    // } elseif ($model->gender == $model::GENDER_FEMALE) {
    //     $image = asset('default_img/female-1.jpg');
    // } elseif ($model->gender == $model::GENDER_OTHERS) {
    //     $image = asset('default_img/other-1.png');
    // }
    return $url ? asset('storage/' . $url) : $image;
}
function getSubmitterType($className)
{
    $className = basename(str_replace('\\', '/', $className));
    return trim(preg_replace('/(?<!\ )[A-Z]/', ' $0', $className));
}

function availableTimezones()
{
    $timezones = [];
    $timezoneIdentifiers = DateTimeZone::listIdentifiers();

    foreach ($timezoneIdentifiers as $timezoneIdentifier) {
        $timezone = new DateTimeZone($timezoneIdentifier);
        $offset = $timezone->getOffset(new DateTime());
        $offsetPrefix = $offset < 0 ? '-' : '+';
        $offsetFormatted = gmdate('H:i', abs($offset));

        $timezones[] = [
            'timezone' => $timezoneIdentifier,
            'name' => "(UTC $offsetPrefix$offsetFormatted) $timezoneIdentifier",
        ];
    }

    return $timezones;
}
function isImage($path)
{
    $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp', 'svg'];
    $extension = strtolower(pathinfo($path, PATHINFO_EXTENSION));
    return in_array($extension, $imageExtensions);
}

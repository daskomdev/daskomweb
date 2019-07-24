<?php

use App\Current_Praktikum;
/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('praktikum.{kelas_id}', function ($user, $kelas_id) {
    return $user->kelas_id === $kelas_id;
});

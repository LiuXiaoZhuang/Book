<?php

Route::middleware(['device:Admin'])->group(function () {
    Route::get('/novel_list','Admin\GradNovelController@novelList');
});

?>
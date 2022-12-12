@props(['for'])

@error($for)
<?php
    @toastr()->error( $message );
    ?>
@enderror

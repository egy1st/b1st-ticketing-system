<?php

if (file_exists('install')) {
    header('Location: install');
} else {
    header('Location: CI');
}


?>
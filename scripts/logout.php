<?php
require_once 'db.php';

$_SESSION = [];
session_destroy();

header('Location: ../index.php');
<?php
include "../base.php";

session_destroy();

redirect_to("auth/login.php");

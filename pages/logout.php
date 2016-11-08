<?php
setFlash('Signed out');
session_unset();
redirect('/sql.admin');
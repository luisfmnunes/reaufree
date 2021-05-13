<?php

$sandbox = true;

if ($sandbox) {
	$host = getenv("DB_HOST");
	$database = getenv("DB_DATABASE");
	$usuario = getenv("DB_USUARIO");
	$senha = getenv("DB_SENHA");
} else {
	$host = getenv("DB_HOST_LOCAL");
	$database = getenv("DB_DATABASE");
	$usuario = getenv("DB_USUARIO");
	$senha = getenv("DB_SENHA");
}

$conexao = mysqli_connect($host, $usuario, $senha, $database);

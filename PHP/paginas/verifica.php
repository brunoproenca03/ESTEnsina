<?php
include "tipoUtilizadores.php";
include 'C:\xampp\htdocs\BrunoProenca_DiogoCanoso\basedados\basedados.h';
session_start();

if (!isset($_SESSION["user"]) || !isset($_SESSION["tipo_utilizador"])) {

	$_SESSION["bt"] = "Página Login";
	$_SESSION["erro"] = "Algo não correu bem!!! Dirija-se para a Página de Login ou Registe-se";
	$_SESSION["diretoria"] = "login.php";
	echo "<script>  setTimeout(function () { window.location.href = 'Msg_erro.php'; }, 0)</script>";

} else {

	if ($_SESSION["tipo_utilizador"] == ALUNO_NAO_VALIDADO) {

		$_SESSION["bt"] = "Voltar";
		$_SESSION["erro"] = "Conta Ainda Não validada!<br>Por favor, Tente mais tarde!";
		$_SESSION["diretoria"] = "index.php";
		echo "<script>  setTimeout(function () { window.location.href = 'Msg_erro.php'; }, 0)</script>";

	} else if ($_SESSION["user"] == -1 || $_SESSION["tipo_utilizador"] == -1) {

		$_SESSION["bt"] = "Voltar";
		$_SESSION["erro"] = "Combinação inválida!<br>Por favor, Preencha todos os campos corretamente.";
		$_SESSION["diretoria"] = "login.php";
		echo "<script>  setTimeout(function () { window.location.href = 'Msg_erro.php'; }, 0)</script>";

	} else {
		echo " <script> alert ('Fez Login') </script>";
		echo "<script>  setTimeout(function () { window.location.href = 'PaginaUtilizador.php'; }, 0)</script>";
	}
}

?>
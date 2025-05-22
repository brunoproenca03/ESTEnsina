<%@ page contentType="text/html; charset=UTF-8" pageEncoding="UTF-8"%>
<%@	include	file	=	"../basedados/basedados.h"%>
<%@ include file="tipoUtilizadores.jsp" %>
<%
    String tipoUtilizadorStr = (String) session.getAttribute("tipo_utilizador");
    
    if(tipoUtilizadorStr != null){

      int tipoUtilizador = Integer.parseInt(tipoUtilizadorStr);

      if (session.getAttribute("user") != null && session.getAttribute("id") != null && (tipoUtilizador != ALUNO_NAO_VALIDADO && tipoUtilizador != VISITANTE) ) {
          out.println("<script>alert('Têm uma sessão iniciada, faça o logout da conta atual!!');</script>");
          out.println("<script>setTimeout(function() { window.location.href = 'index.jsp'; }, 0);</script>");
      }
      
    }

    
%>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Registo</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="main.css" />
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  </head>
  <body>
    <div class="container">
      <div class="form-wrap">
        <h1>Registo</h1>
        <form method="POST" action="processa_registo.jsp">
          <div class="form-group">
            <label for="new-name">Nome</label>
            <input type="text" id="new-name" name="new-name" required />
          </div>
          <div class="form-group">
            <label for="new-data">Data de Nascimento</label>
            <input type="date" id="new-data" name="new-data" required />
          </div>
          <div class="form-group">
            <label for="new-email">E-mail</label>
            <input type="email" id="new-email" name="new-email" required />
          </div>
          <div class="form-group">
            <label for="new-morada">Morada</label>
            <input type="text" id="new-morada" name="new-morada" required />
          </div>
          <div class="form-group">
            <label for="new-password">Senha</label>
            <input
              type="password"
              id="new-password"
              name="new-password"
              required
            />
          </div>
          <div class="form-group">
            <label for="new-phone">Telefone</label>
            <input type="text" id="new-phone" name="new-phone" required />
          </div>
          <div class="form-group">
            <input type="submit" value="Registrar" />
          </div>
        </form>
        <p>Já tem uma conta? <a href="login.jsp">Faça login aqui</a>.</p>
      </div>
    </div>
  </body>
</html>

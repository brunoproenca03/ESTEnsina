<%@ page contentType="text/html; charset=UTF-8" pageEncoding="UTF-8"%>
<%@ page language="java" import="java.sql.*, javax.servlet.http.*, javax.servlet.*" %>
<%@ include file="../basedados/basedados.h" %>
<%@ include file="tipoUtilizadores.jsp" %>
<%
    String tipoUtilizadorStr = (String) session.getAttribute("tipo_utilizador");
    
    if(tipoUtilizadorStr != null){

      int tipoUtilizador = Integer.parseInt(tipoUtilizadorStr);

      if (session.getAttribute("user") != null && session.getAttribute("id") != null && (tipoUtilizador != ALUNO_NAO_VALIDADO && tipoUtilizador != VISITANTE) ) {
          out.println("<script>alert('Têm uma sessão iniciada, faça o logout da conta atual!!');</script>");
          out.println("<script>setTimeout(function() { window.location.href = 'index.jsp'; }, 0);</script>");
      } else {
        response.sendRedirect("verifica.jsp");
      }
      
    }

    
%>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="main.css" />
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  </head>
  <body>
    <div class="container">
      <div class="form-wrap">
        <h1>Login</h1>
        <form method="POST" action="processa_login.jsp">
          <div class="form-group">
            <label for="name">Nome</label>
            <input type="text" id="name" name="name" required />
          </div>
          <div class="form-group">
            <label for="password">Senha</label>
            <input type="password" id="pass" name="pass" required />
          </div>
          <div class="form-group">
            <input type="submit" value="OK" />
          </div>
        </form>
        <p>
          Ainda não tem uma conta? <a href="registo.jsp">Registe-se aqui</a>.
        </p>
      </div>
    </div>
  </body>
</html>

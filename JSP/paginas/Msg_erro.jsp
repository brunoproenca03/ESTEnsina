<html>

<head>
  <style>
    body {
      background-image: url(../media/imgs_sistema/fundoLogin.jpg);
      background-position: top center;
    }

    #erro-box {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      width: 380px;
      height: 300px;
      margin: 140px auto 0px;
      background-color: #F78181;
      box-shadow: 0px 0px 5px #6F6666;
      border-radius: 10px;
    }

    #erro-cabecalho {
      background: #f00;
      border-radius: 10px 10px 0 0;
      box-shadow: 0 0 30px rgba(0, 0, 0, 0.1);
      padding: 20px;
      font: bold 25px sans-serif;
      color: white;
      text-align: center;
      margin-bottom: 46px;
      width: 89%;
    }

    .input-div {
      margin: 20px;
      padding: 5px;
      font: bold 15px sans-serif;
      color: black;
      display: flex;
      flex-direction: column;
      align-items: center;
      text-align: center;
    }

    .input-div input {
      width: 325px;
      height: 35px;
      padding-left: 7px;
      font: normal 13px sans-serif;
      color: #0B6121;
    }

    #input-pass {
      margin-top: -15px;
    }

    #input-user {
      margin-top: 10px;
    }

    #acoes {
      width: 100%;
      margin: 25px 0;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    #registo {
      margin-top: 10px;
    }

    input[type=submit] {
      background-color: #f00;
      color: #fff;
      border-radius: 5px;
      padding: 12px;
      font-size: 16px;
      cursor: pointer;
      transition: background-color 0.3s ease-in-out;
      width: 45%;
      font: bold 13px sans-serif;
      border: none;
      margin-right: 50px;
      /* Adicionado margem à direita */
    }

    a {
      color: #fff;
      text-decoration: none;
      font: bold 13px sans-serif;
    }
  </style>
</head>

<body>

<%@ page contentType="text/html; charset=UTF-8" pageEncoding="UTF-8" %>
<%@ page language="java" import="javax.servlet.http.*, javax.servlet.*, java.util.*" %>
<%@ include file="../basedados/basedados.h" %>
<%@ include file="tipoUtilizadores.jsp" %>

<%
    String tipoUtilizadorStr = (String) session.getAttribute("tipo_utilizador");

    if(tipoUtilizadorStr == null) {

        String msg = "Algo não correu bem!!! Dirija-se para a Página de Login ou Registe-se";
        String btn = "Página Login";
        String dir = "login.jsp";

        if (session.getAttribute("erro") != null) {
            msg = (String) session.getAttribute("erro");
        }
        if (session.getAttribute("bt") != null) {
            btn = (String) session.getAttribute("bt");
        }
        if (session.getAttribute("dir") != null) {
            dir = (String) session.getAttribute("dir");
        }

        session.invalidate();
%>

<div id='erro-box'>
  <div id='erro-cabecalho'>Lamentamos...</div>

  <div class='input-div' id='input-user'>
      <%= msg %>
  </div> 
  <!--=====================Login=====================-->
  <form action="<%= dir %>">
      <div id='acoes'>
          <input type='submit' value='<%= btn %>'>
          <div id='registo'><a href='registo.jsp'>Registe-se...</a></div>
      </div>
  </form>
</div>

<%
    } else {
          int tipoUtilizador = Integer.parseInt(tipoUtilizadorStr);

          if(tipoUtilizador == VISITANTE || tipoUtilizador == ALUNO_NAO_VALIDADO || session.getAttribute("user").equals(-1) || session.getAttribute("tipo_utilizador").equals(-1) || session.getAttribute("user") == null || session.getAttribute("tipo_utilizador") == null) {
              String msg = "Conta Ainda Não validada!<br>Por favor, Tente mais tarde!";
              String btn = "Voltar";
              String dir = "index.jsp";
      
              if (session.getAttribute("erro") != null) {
                  msg = (String) session.getAttribute("erro");
              }
              if (session.getAttribute("bt") != null) {
                  btn = (String) session.getAttribute("bt");
              }
              if (session.getAttribute("dir") != null) {
                  dir = (String) session.getAttribute("dir");
              }
      
              session.invalidate();

%>

  <div id='erro-box'>
    <div id='erro-cabecalho'>Lamentamos...</div>

    <div class='input-div' id='input-user'>
        <%= msg %>
    </div> 
    <!--=====================Login=====================-->
    <form action="<%= dir %>">
        <div id='acoes'>
            <input type='submit' value='<%= btn %>'>
            <div id='registo'><a href='registo.jsp'>Registe-se...</a></div>
        </div>
    </form>
  </div>

<%        }

          if(tipoUtilizador == ADMINISTRADOR || tipoUtilizador == DOCENTE || tipoUtilizador == ALUNO){
             response.sendRedirect("index.jsp");
          }

    }
    
   
%>


</body>

</html>

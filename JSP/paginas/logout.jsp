<%@ page contentType="text/html; charset=UTF-8" pageEncoding="UTF-8" %>
<%@ include file="../basedados/basedados.h" %>
<%@ include file="tipoUtilizadores.jsp" %>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Logout</title>
</head>
<body>
    <% 
    if (session.getAttribute("user") != null && session.getAttribute("id") != null && session.getAttribute("tipo_utilizador") != "4" && session.getAttribute("tipo_utilizador") != "5") {
        session.invalidate(); // Encerra a sessão
		response.sendRedirect("index.jsp");
    } else {
        response.sendRedirect("Msg_erro.jsp");
    }
        
    %>
</body>
</html>
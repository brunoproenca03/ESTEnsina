<%@ page contentType="text/html; charset=UTF-8" pageEncoding="UTF-8" %>
<%@ page language="java" import="java.sql.*, javax.servlet.*, javax.servlet.http.*, java.text.SimpleDateFormat" %>
<%@ include file="../basedados/basedados.h" %>
<%@ include file="tipoUtilizadores.jsp" %>
<%@ include file="encripta.jsp" %>

<%
	request.setCharacterEncoding("UTF-8");
	response.setContentType("text/html; charset=UTF-8");
	
    if (session.getAttribute("user") == null && session.getAttribute("id") == null && session.getAttribute("tipo_utilizador") == null) {
        String nomeUtilizador = request.getParameter("new-name");
        String data = request.getParameter("new-data");
        String email = request.getParameter("new-email");
        String morada = request.getParameter("new-morada");
        String pass = request.getParameter("new-password");
        String telefone = request.getParameter("new-phone");

        try {
            Statement stmt = conn.createStatement();
            String sql = "SELECT * FROM utilizador WHERE nome = '" + nomeUtilizador + "'";
            ResultSet res = stmt.executeQuery(sql);
            
            if (res.next()) {
                out.println("<script>alert('Já existe esse utilizador');</script>");
                out.println("<script>setTimeout(function () { window.location.href = 'index.jsp'; }, 0);</script>");
            } else {
                sql = "INSERT INTO utilizador (nome, data_nascimento, pass, morada, email, telemovel, tipo_utilizador) " +
                      "VALUES ('" + nomeUtilizador + "', '" + data + "', '" + encriptar(pass) + "', '" + morada + "', '" + email + "', '" + telefone + "', '4')";
                stmt.executeUpdate(sql);
                response.sendRedirect("index.jsp");
            }

            stmt.close();
            conn.close();
        } catch (Exception ex) {
            ex.printStackTrace();
            out.println("Erro: " + ex.getMessage());
        }
    } else {
        response.sendRedirect("index.jsp");
    }
%>

<%@ page contentType="text/html; charset=UTF-8" pageEncoding="UTF-8"%>
<%@ page language="java" import="java.sql.*, javax.servlet.http.*, javax.servlet.*, java.security.*" %>
<%@ include file="../basedados/basedados.h" %>
<%@ include file="tipoUtilizadores.jsp" %>
<%@ include file="encripta.jsp" %>
<%

	request.setCharacterEncoding("UTF-8");
	response.setContentType("text/html; charset=UTF-8");
	 
if (session.getAttribute("user") == null && session.getAttribute("id") == null && session.getAttribute("tipo_utilizador") == null) {
    if(request.getParameter("name") != null && request.getParameter("pass") != null){
        String nome = request.getParameter("name");
        String pass = request.getParameter("pass");
		boolean utilizadorValido = false;
        try{
            Statement stmt = conn.createStatement();
            ResultSet utilizador = stmt.executeQuery("SELECT * FROM utilizador WHERE nome = '"+ nome +"' AND pass = '"+ encriptar(pass)+"' AND tipo_utilizador != '"+ VISITANTE +"'");
            while(utilizador.next()){
				utilizadorValido = true;
				
                String id = utilizador.getString("id_utilizador");
                String tipo = utilizador.getString("tipo_utilizador");
                String password = utilizador.getString("pass");
                String nomeUtilizador = utilizador.getString("nome");

                if(nomeUtilizador != null && nome.equals(nomeUtilizador) && password != null && encriptar(pass).equals(password)){
                    session.setAttribute("user",nome);
                    session.setAttribute("tipo_utilizador",tipo);
                    session.setAttribute("id",id);
                } else {
                    session.setAttribute("user",-1);
                    session.setAttribute("tipo_utilizador",-1);
                }
                out.println("<div id='loading'>Aguarde a ser reencaminhado...</div> <script> setTimeout(function () { window.location.href = 'verifica.jsp'; }, 1000)</script>");
            }
			
			if (!utilizadorValido) {
                out.println("<script> alert('Utilizador não encontrado ou senha incorreta.'); window.location.href = 'Msg_erro.jsp'; </script>");
            }

            utilizador.close();
            conn.close();
            stmt.close();

        } catch (Exception ex){
            ex.printStackTrace();
            out.println("Erro: " + ex.getMessage());
        }

    } else {
        session.invalidate();
        response.sendRedirect("index.jsp");
    }
    
} else {
    session.invalidate();
    response.sendRedirect("index.jsp");
}
%>
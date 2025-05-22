<%@ page contentType="text/html; charset=UTF-8" pageEncoding="UTF-8"%>
<%@ page language="java" import="java.sql.*, javax.servlet.http.*, javax.servlet.*, java.security.*" %>
<%@ include file="../basedados/basedados.h" %>
<%@ include file="tipoUtilizadores.jsp" %>

<% 
	String tipoUtilizadorStr = (String) session.getAttribute("tipo_utilizador");
	int tipoUtilizadorSessao = Integer.parseInt(tipoUtilizadorStr);

	if(session.getAttribute("user") != null && session.getAttribute("id") != null && tipoUtilizadorSessao == ADMINISTRADOR){
		String nome = request.getParameter("nome");
		String nomeUser = (String) session.getAttribute("user");
		try {
			Statement stmt = conn.createStatement();
            ResultSet dadosUtilizador = stmt.executeQuery("SELECT tipo_utilizador FROM utilizador WHERE nome = '"+nome+"'");
			while(dadosUtilizador.next()){
				String tipo = dadosUtilizador.getString("tipo_utilizador");
				int tipoUtilizador = Integer.parseInt(tipo);
				
				if(tipoUtilizador == ADMINISTRADOR){
					try {

						if(nome.equals(nomeUser)){
							session.setAttribute("tipo_utilizador","2");
						}

						String update = "UPDATE utilizador SET tipo_utilizador= ? WHERE nome= ?";
											
						PreparedStatement ps= conn.prepareStatement(update);
						ps.setString(1,	"2");
						ps.setString(2,	nome);
						
						ps.executeUpdate();
						
						ps.close();
					
					} catch (Exception ex) {
						ex.printStackTrace();
						out.println("Erro: " + ex.getMessage());
					}
					
				} else if(tipoUtilizador == DOCENTE){
					try {

						if(nome.equals(nomeUser)){
							session.setAttribute("tipo_utilizador","3");
						}

						String update = "UPDATE utilizador SET tipo_utilizador= ? WHERE nome= ?";
										
						PreparedStatement ps= conn.prepareStatement(update);
						ps.setString(1,	"3");
						ps.setString(2,	nome);
						
						ps.executeUpdate();
						
						ps.close();
						
					} catch (Exception ex) {
						ex.printStackTrace();
						out.println("Erro: " + ex.getMessage());
					}
				} else if(tipoUtilizador == ALUNO){
					try {

						if(nome.equals(nomeUser)){
							session.setAttribute("tipo_utilizador","4");
						}

						String update = "UPDATE utilizador SET tipo_utilizador= ? WHERE nome= ?";
											
						PreparedStatement ps= conn.prepareStatement(update);
						ps.setString(1,	"4");
						ps.setString(2,	nome);
						
						ps.executeUpdate();
						
						ps.close();
					
					} catch (Exception ex) {
						ex.printStackTrace();
						out.println("Erro: " + ex.getMessage());
					}
					
				}
				
			}
			stmt.close();
			conn.close();
			response.sendRedirect("GestaoUtilizador.jsp");
			
		} catch (Exception ex) {
			ex.printStackTrace();
			out.println("Erro: " + ex.getMessage());
		}
	} else {
		response.sendRedirect("logout.jsp");
	}
%>
<%@ page contentType="text/html; charset=UTF-8" pageEncoding="UTF-8"%>
<%@ page language="java" import="java.sql.*, javax.servlet.http.*, javax.servlet.*, java.security.*" %>
<%@ include file="../basedados/basedados.h" %>
<%@ include file="tipoUtilizadores.jsp" %>
<%@ include file="encripta.jsp" %>


<%
	 request.setCharacterEncoding("UTF-8");
	 response.setContentType("text/html; charset=UTF-8");

	 String tipoUtilizadorStr = (String) session.getAttribute("tipo_utilizador");
	 int tipoUtilizadorSessao = Integer.parseInt(tipoUtilizadorStr);
 
	if(session.getAttribute("user") != null && session.getAttribute("id") != null && tipoUtilizadorSessao == ADMINISTRADOR){
		
		String nomeUtilizador = request.getParameter("nome");
		String data = request.getParameter("data");
		String tipo = request.getParameter("tipo");
		String email = request.getParameter("email");
		String morada = request.getParameter("morada");
		String telemovel = request.getParameter("telemovel");
		String pass = request.getParameter("pass");
		
		
		try {
            // Verificação se o utilizador já existe
            String verifica = "SELECT nome FROM utilizador WHERE nome = ?";
            PreparedStatement verificaStmt = conn.prepareStatement(verifica);
            verificaStmt.setString(1, nomeUtilizador);
            ResultSet verificaRS = verificaStmt.executeQuery();
            
            if (verificaRS.next()) {
                out.println("<script>alert('Já existe um utilizador com este nome'); window.location.href='PaginaNovoUtilizador.jsp';</script>");
                verificaStmt.close();
                verificaRS.close();
            }
            
            verificaStmt.close();
            verificaRS.close();
        } catch (Exception ex) {
            ex.printStackTrace();
            out.println("Erro: " + ex.getMessage());
        }
		
		try {
			Statement stmt = conn.createStatement();
            ResultSet dadosUtilizador = stmt.executeQuery("SELECT id_tipo FROM tipoutilizador WHERE tipoutilizador = '"+ tipo +"'");
			while(dadosUtilizador.next()){
				String tipoDeUtilizador = dadosUtilizador.getString("id_tipo");
				int tipoUtilizador = Integer.parseInt(tipoDeUtilizador);
			
				if(tipoUtilizador == ADMINISTRADOR) {
					try {
						String	insert= "INSERT	INTO utilizador (nome,data_nascimento,email,morada,pass,telemovel,tipo_utilizador) VALUES (?,?,?,?,?,?,?)";
						
						PreparedStatement ps= conn.prepareStatement(insert); 
						ps.setString(1,	nomeUtilizador); 
						ps.setString(2,	data); 
						ps.setString(3,	email); 
						ps.setString(4,	morada); 
						ps.setString(5,	encriptar(pass));
						ps.setString(6,	telemovel);
						ps.setString(7,	"1");
						
						ps.executeUpdate();
						
						ps.close();
						conn.close();
						
						response.sendRedirect("GestaoUtilizador.jsp");
						
					} catch (Exception ex) {
						ex.printStackTrace();
						out.println("Erro: " + ex.getMessage());
					}
					
				} else if(tipoUtilizador == DOCENTE) {
					try {
						String	insert= "INSERT	INTO utilizador (nome,data_nascimento,email,morada,pass,telemovel,tipo_utilizador) VALUES (?,?,?,?,?,?,?)";
						
						PreparedStatement ps= conn.prepareStatement(insert); 
						ps.setString(1,	nomeUtilizador); 
						ps.setString(2,	data); 
						ps.setString(3,	email); 
						ps.setString(4,	morada); 
						ps.setString(5,	encriptar(pass));
						ps.setString(6,	telemovel);
						ps.setString(7,	"2");
						
						ps.executeUpdate();
						
						ps.close();
						conn.close();
						
						response.sendRedirect("GestaoUtilizador.jsp");
						
					} catch (Exception ex) {
						ex.printStackTrace();
						out.println("Erro: " + ex.getMessage());
					}
					
				} else if(tipoUtilizador == ALUNO) {
					try {
						String	insert= "INSERT	INTO utilizador (nome,data_nascimento,email,morada,pass,telemovel,tipo_utilizador) VALUES (?,?,?,?,?,?,?)";
						
						PreparedStatement ps= conn.prepareStatement(insert); 
						ps.setString(1,	nomeUtilizador); 
						ps.setString(2,	data); 
						ps.setString(3,	email); 
						ps.setString(4,	morada); 
						ps.setString(5,	encriptar(pass));
						ps.setString(6,	telemovel);
						ps.setString(7,	"3");
						
						ps.executeUpdate();
						
						ps.close();
						conn.close();
						
						response.sendRedirect("GestaoUtilizador.jsp");
						
					} catch (Exception ex) {
						ex.printStackTrace();
						out.println("Erro: " + ex.getMessage());
					}
					
				}
				
			}
		
		} catch (Exception ex) {
				ex.printStackTrace();
				out.println("Erro: " + ex.getMessage());
		}
		
		
		
	} else {
		response.sendRedirect("logout.jsp");
	}


%>
<%@ page contentType="text/html; charset=UTF-8" pageEncoding="UTF-8" %>
<%@ page language="java" import="java.sql.*, javax.servlet.*, javax.servlet.http.*, java.util.*" %>
<%@ include file="../basedados/basedados.h" %>
<%@ include file="tipoUtilizadores.jsp" %>

<%! 
    public int calcularIdade(String dataNascimento) {
        Calendar aniversario = Calendar.getInstance();
        Calendar hoje = Calendar.getInstance();

        String[] partes = dataNascimento.split("-");
        int ano = Integer.parseInt(partes[0]);
        int mes = Integer.parseInt(partes[1]);
        int dia = Integer.parseInt(partes[2]);

        aniversario.set(ano, mes - 1, dia);

        int idade = hoje.get(Calendar.YEAR) - aniversario.get(Calendar.YEAR);

        if (hoje.get(Calendar.MONTH) < aniversario.get(Calendar.MONTH) || 
            (hoje.get(Calendar.MONTH) == aniversario.get(Calendar.MONTH) && hoje.get(Calendar.DAY_OF_MONTH) < aniversario.get(Calendar.DAY_OF_MONTH))) {
            idade--;
        }

        return idade;
    }
%>

<%
	String tipoUtilizadorStr = (String) session.getAttribute("tipo_utilizador");
	int tipoUtilizador = Integer.parseInt(tipoUtilizadorStr);
	
    if (session.getAttribute("user") != null && session.getAttribute("id") != null && tipoUtilizador == ADMINISTRADOR ) {

        String idCurso = request.getParameter("curso");
        String idAluno = request.getParameter("aluno");

        try {
            Statement stmt = conn.createStatement();

            // Obter a data de nascimento do aluno
            String sql = "SELECT data_nascimento FROM utilizador WHERE id_utilizador = '" + idAluno + "'";
            ResultSet data = stmt.executeQuery(sql);
			while(data.next()){
				String dataDeNascimento = data.getString("data_nascimento");
				int idade = calcularIdade(dataDeNascimento);
				
					if (idade >= 20) {
						try {
							Statement stmt2 = conn.createStatement();
							sql = "SELECT capacidade, inscritos FROM curso WHERE id_curso = '" + idCurso + "'";
							ResultSet quantidade = stmt2.executeQuery(sql);
							
							while(quantidade.next()){
								String capacidade = quantidade.getString("capacidade");
								String inscritos = quantidade.getString("inscritos");
								int capacidadeDoCurso = Integer.parseInt(capacidade);
								int inscritosNoCurso = Integer.parseInt(inscritos);
								
								if (inscritosNoCurso == capacidadeDoCurso) {
									out.println("<script> alert('O curso atingiu o limite de vagas. Já não é possível aceitar Inscrições'); window.location.href = 'gerirInscricoes.jsp'; </script>");
								} else {
									try {
										Statement stmt3 = conn.createStatement();
										sql = "SELECT estadoInscricao FROM estadoinscricao WHERE descricao = 'Aceite'";
										ResultSet estadoInscricao = stmt3.executeQuery(sql);
										
										while(estadoInscricao.next()){
											String estado = estadoInscricao.getString("estadoInscricao");
											
											try {
												String update = "UPDATE inscricao SET estadoDaInscricao = ? WHERE curso = ? AND aluno = ?";
												PreparedStatement ps = conn.prepareStatement(update);
												
												ps.setString(1,	estado);
												ps.setString(2,	idCurso);
												ps.setString(3,	idAluno);
												
												ps.executeUpdate();
												inscritosNoCurso += 1;
												
												ps.close();
												
												try {
													
													String updates = "UPDATE curso SET inscritos = ? WHERE id_curso = ?";
													PreparedStatement ps2 = conn.prepareStatement(updates);
													
													String inscritosCurso = Integer.toString(inscritosNoCurso);
													
													ps2.setString(1,inscritosCurso);
													ps2.setString(2,idCurso);
													
													ps2.executeUpdate();
													
													ps2.close();
													
													out.println("<script> window.location.href = 'gerirInscricoes.jsp'; </script>");
													
												} catch (Exception ex){
													ex.printStackTrace();
													out.println("Erro: " + ex.getMessage());
												}
												
											} catch (Exception ex){
												ex.printStackTrace();
												out.println("Erro: " + ex.getMessage());
											}
											
										}
										stmt3.close();
									
									} catch (Exception ex){
										ex.printStackTrace();
										out.println("Erro: " + ex.getMessage());
									}
									
								}
								
								
							}
							stmt2.close();
						 } catch (Exception ex) {
							ex.printStackTrace();
							out.println("Erro: " + ex.getMessage());
						}
					
				} else {
					out.println("<script> alert('O aluno tem de ter 20 anos ou mais'); window.location.href = 'gerirInscricoes.jsp'; </script>");
				}
            }
			stmt.close();
            conn.close();
        } catch (Exception ex) {
            ex.printStackTrace();
            out.println("Erro: " + ex.getMessage());
        }

    } else {
        response.sendRedirect("logout.jsp");
    }
%>

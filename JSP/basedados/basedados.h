<%@ page language = "java" import = "java.sql.*" %>
<%
    Connection conn = null;
    String bdname = "estEnsina";

    Class.forName("com.mysql.jdbc.Driver").newInstance();
    String jdbcURL = "jdbc:mysql://localhost:3306/" + bdname;
    conn = DriverManager.getConnection(jdbcURL, "root", "");
%>
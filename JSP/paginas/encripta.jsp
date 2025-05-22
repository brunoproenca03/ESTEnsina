<%@ page language="java" contentType="text/html; charset=UTF-8" pageEncoding="UTF-8"%>
<%@ page import="java.security.MessageDigest"%>
<%@ page import="java.io.*"%>
<%@ page import="java.nio.charset.StandardCharsets"%>
<%@ page import="java.security.NoSuchAlgorithmException"%>
<%!
    String encriptar(String pwd) {
        try {
            MessageDigest md = MessageDigest.getInstance("MD5");
            byte[] passBytes = pwd.getBytes(StandardCharsets.UTF_8);
            byte[] passHash = md.digest(passBytes);
            
            StringBuilder stringbuilder = new StringBuilder();
            for (int i = 0; i < passHash.length; i++)
                stringbuilder.append(Integer.toString((passHash[i] & 0xff) + 0x100, 16).substring(1));
			
            return stringbuilder.toString();
        } catch (NoSuchAlgorithmException e) {
			e.printStackTrace();
		}
		return null;
	}
%>
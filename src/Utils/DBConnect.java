/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package Utils;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;
import java.util.logging.Level;
import java.util.logging.Logger;

/**
 *
 * @author Eya
 */
public class DBConnect {
    private static String HOST = "127.0.0.1";
        private static int PORT = 3306;
        private static String DB_NAME = "pii";
        private static String USERNAME = "root";
        private static String PASSWORD = "";
        private static Connection connection ;
        
        
        public static Connection getConnect (){
        try {
            connection = DriverManager.getConnection(String.format("jdbc:mysql://%s:%d/%s", HOST,PORT,DB_NAME),USERNAME,PASSWORD);
            System.out.println("Success");
        } catch (SQLException ex) {
            Logger.getLogger(DBConnect.class.getName()).log(Level.ALL.SEVERE, null, ex);
        }
            
            return  connection;
        }
}

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package Services;

import Models.Question;
import Utils.DBConnect;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;

/**
 *
 * @author Eya
 */
public class QuestionService {
     String query = null;
    Connection connection = null ;
    PreparedStatement preparedStatement = null ;
    ResultSet resultSet = null ;
   Question question = null;

    public QuestionService() {
    }
    
    public ObservableList<Question> Afficher() {
        
        ObservableList<Question> QuestionList=FXCollections.observableArrayList();
        try {
        connection = DBConnect.getConnect();
            query = "SELECT * FROM `question`";
            preparedStatement = connection.prepareStatement(query);
            resultSet = preparedStatement.executeQuery();
            
            while (resultSet.next()){
                QuestionList.add(new  Question(
                        resultSet.getInt(1),
                        resultSet.getString(2),
                         resultSet.getString(3),
                         resultSet.getString(4),
                         resultSet.getString(5),
                        resultSet.getInt(6)));
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }
        return QuestionList;
    }
       public void Ajouter(String enonce,String choix1, String choix2,String choix3, int id_quiz){

        try {
        connection = DBConnect.getConnect();
            query = "INSERT INTO `question`( `enonce`, `choix1`, `choix2`,`choix3`,`id_quiz`) VALUES (?,?,?,?,?)";
            preparedStatement = connection.prepareStatement(query);
            preparedStatement.setString(1, enonce);
            preparedStatement.setString(2, choix1);
            preparedStatement.setString(3, choix2);
            preparedStatement.setString(4, choix3);
            preparedStatement.setInt(5,id_quiz);
            preparedStatement.execute();

        } catch (SQLException ex) {
        }

    }
        public void modifier(int id,String enonce,String choix1, String choix2,String choix3, int id_quiz) {

        try {
        connection = DBConnect.getConnect();
            query = "UPDATE `question` SET "
                    + "`enonce`=?,"
                    + "`choix1`=?,"
                     + "`choix2`=?,"
                     + "`choix3`=?,"
                    + "`id_quiz`= ? WHERE id = '"+id+"'";
            preparedStatement = connection.prepareStatement(query);
            preparedStatement.setString(1, enonce);
            preparedStatement.setString(2, choix1);
            preparedStatement.setString(3, choix2);
             preparedStatement.setString(4, choix3);
              preparedStatement.setInt(5,id_quiz);
            preparedStatement.execute();

        } catch (SQLException ex) {
        }

    }
    public void Supprimer(int id) throws SQLException{
        query = "DELETE FROM `question` WHERE id  ="+id;
        connection = DBConnect.getConnect();
        preparedStatement = connection.prepareStatement(query);
        preparedStatement.execute();
    }
}

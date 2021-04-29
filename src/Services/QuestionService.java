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
                        resultSet.getInt(2),
                        resultSet.getString(3),
                         resultSet.getString(4),
                         resultSet.getString(5),
                         resultSet.getString(6),
                        resultSet.getString(7)
                ));
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }
        return QuestionList;
    }
       public void Ajouter(int quiz_id, String enonce,String choix1, String choix2,String choix3,  String reponse){

        try {
        connection = DBConnect.getConnect();
            query = "INSERT INTO `question`( `quiz_id`,`enonce`, `choix1`, `choix2`,`choix3`,`reponse`) VALUES (?,?,?,?,?,?)";
            preparedStatement = connection.prepareStatement(query);
            preparedStatement.setInt(1,quiz_id);
            preparedStatement.setString(2, enonce);
            preparedStatement.setString(3, choix1);
            preparedStatement.setString(4, choix2);
            preparedStatement.setString(5, choix3);
            preparedStatement.setString(6,reponse);
            preparedStatement.execute();

        } catch (SQLException ex) {
        }

    }
        public void modifier(int id  ,int quiz_id, String enonce, String choix1, String choix2  ,String choix3, String reponse) {

        try {
        connection = DBConnect.getConnect();
            query = "UPDATE `question` SET "
                     + "`quiz_id`=?,"
                    + "`enonce`=?,"
                    + "`choix1`=?,"
                     + "`choix2`=?,"
                     + "`choix3`=?,"
                    + "`reponse`= ?, WHERE id = '"+id+"'";
            preparedStatement = connection.prepareStatement(query);
            preparedStatement.setInt(1,quiz_id);
            preparedStatement.setString(2, enonce);
            preparedStatement.setString(3, choix1);
            preparedStatement.setString(4, choix2);
             preparedStatement.setString(5, choix3);
             preparedStatement.setString(6,reponse);
              
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

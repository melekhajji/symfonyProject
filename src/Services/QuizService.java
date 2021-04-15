/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package Services;

import Models.Quiz;
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
public class QuizService {
    String query = null;
    Connection connection = null ;
    PreparedStatement preparedStatement = null ;
    ResultSet resultSet = null ;
    Quiz quiz = null;

    public QuizService() {
    }
    
    public ObservableList<Quiz>Afficher() {
        
        ObservableList<Quiz> QuizList=FXCollections.observableArrayList();
        try {
        connection = DBConnect.getConnect();
            query = "SELECT * FROM `quiz`";
            preparedStatement = connection.prepareStatement(query);
            resultSet = preparedStatement.executeQuery();
            
            while (resultSet.next()){
                QuizList.add(new  Quiz(
                        resultSet.getInt(1),
                        resultSet.getString(2),
                        resultSet.getInt(3),
                        resultSet.getInt(4)));
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }
        return QuizList;
    }
    
    public void Ajouter(String theme,int duree, int nbquestion){

        try {
        connection = DBConnect.getConnect();
            query = "INSERT INTO `quiz`( `theme`, `duree`, `nbquestion`) VALUES (?,?,?)";
            preparedStatement = connection.prepareStatement(query);
            preparedStatement.setString(1, theme);
            preparedStatement.setInt(2, duree);
            preparedStatement.setInt(3, nbquestion);
            preparedStatement.execute();

        } catch (SQLException ex) {
        }

    }
    
    public void modifier(int id,String theme,int duree, int nbquestion) {

        try {
        connection = DBConnect.getConnect();
            query = "UPDATE `quiz` SET "
                    + "`theme`=?,"
                    + "`duree`=?,"
                    + "`nbquestion`= ? WHERE id = '"+id+"'";
            preparedStatement = connection.prepareStatement(query);
            preparedStatement.setString(1, theme);
            preparedStatement.setInt(2, duree);
            preparedStatement.setInt(3, nbquestion);
            preparedStatement.execute();

        } catch (SQLException ex) {
        }

    }
    
    public void Supprimer(int id) throws SQLException{
        query = "DELETE FROM `quiz` WHERE id  ="+id;
        connection = DBConnect.getConnect();
        preparedStatement = connection.prepareStatement(query);
        preparedStatement.execute();
    }
}

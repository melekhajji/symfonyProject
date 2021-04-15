/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package Services;

import Models.Question;
import Models.Reponse;
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
public class ReponseService {
     String query = null;
    Connection connection = null ;
    PreparedStatement preparedStatement = null ;
    ResultSet resultSet = null ;
   Reponse reponse = null;

    public ReponseService() {
    }
    
    public ObservableList<Reponse> Afficher() {
        
        ObservableList<Reponse> ReponseList=FXCollections.observableArrayList();
        try {
        connection = DBConnect.getConnect();
            query = "SELECT * FROM `reponse`";
            preparedStatement = connection.prepareStatement(query);
            resultSet = preparedStatement.executeQuery();
            
            while (resultSet.next()){
               ReponseList.add(new  Reponse(
                        resultSet.getInt(1),
                        resultSet.getString(2),
                      
                        resultSet.getInt(3)));
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }
        return ReponseList;
    }
    
       public void Ajouter(String libelle,int id_question){

        try {
        connection = DBConnect.getConnect();
            query = "INSERT INTO `reponse`( `libelle`, `id_question`) VALUES (?,?)";
            preparedStatement = connection.prepareStatement(query);
            preparedStatement.setString(1, libelle);
            preparedStatement.setInt(2, id_question);
          
            preparedStatement.execute();

        } catch (SQLException ex) {
        }

    }
        public void modifier(int id,String libelle,int id_question) {

        try {
        connection = DBConnect.getConnect();
            query = "UPDATE `reponse` SET "
                    + "`libelle`=?,"
                    + "`id_question`= ? WHERE id = '"+id+"'";
            preparedStatement = connection.prepareStatement(query);
               preparedStatement.setString(1, libelle);
            preparedStatement.setInt(2, id_question);
          
            preparedStatement.execute();

        } catch (SQLException ex) {
        }

    
        }
        public void Supprimer(int id) throws SQLException{
        query = "DELETE FROM `reponse` WHERE id  ="+id;
        connection = DBConnect.getConnect();
        preparedStatement = connection.prepareStatement(query);
        preparedStatement.execute();
    }

}

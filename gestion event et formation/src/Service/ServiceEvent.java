/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package Service;

import entites.Event;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.ArrayList;
import java.util.logging.Level;
import java.util.logging.Logger;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import tools.MaConnexion;

/**
 *
 * @author HP
 */
public class ServiceEvent {
   

    Connection cnx = MaConnexion.getInstance().getCnx();
        
     
      
  public  ObservableList<Event> readEvent() {
  
         ObservableList<Event> c = FXCollections.observableArrayList();
        String req = "SELECT * FROM event";
        try {
            Statement st = cnx.createStatement();
            ResultSet resultat = st.executeQuery(req);
            
            while (resultat.next()){
                Event f= new Event();
               
        f.setId(resultat.getInt("ID"));
             f.setStart(resultat.getDate("Start"));
               f.setLieu(resultat.getString("Lieu"));
               f.setImage(resultat.getString("Image"));
               f.setTitle(resultat.getString("Title"));
               f.setEnd(resultat.getDate("End"));
               f.setDescription(resultat.getString("Description"));
               f.setCapacite(resultat.getString("Capacite"));
               
                c.add(f);
            }
            
        } catch (SQLException ex) {
            Logger.getLogger(ServiceEvent.class.getName()).log(Level.SEVERE, null, ex);
        }
        return (c);
    }

   public void ajouterEvent(Event e) {
       try{
            String req="insert into event(start,lieu,image,title,end,description,capacite)"+"Values(?,?,?,?,?,?,?)";
            PreparedStatement ste=cnx.prepareStatement(req);
            ste.setDate(1,e.getStart());
            ste.setString(2, e.getLieu());
             ste.setString(3, e.getImage());
              ste.setString(4, e.getTitle());
               ste.setDate(5, e.getEnd());
                ste.setString(6, e.getDescription());
                
                   ste.setString(7, e.getCapacite());
            
               ste.executeUpdate();
        }catch(SQLException ex){
            Logger.getLogger(ServiceEvent.class.getName()).log(Level.SEVERE, null, ex);
        }
            
    }
   
 
      
     public void deleteEvent(Event p){
        try {
            String requete = "DELETE FROM event WHERE id=?";
            PreparedStatement pst = MaConnexion.getInstance().getCnx()
                    .prepareStatement(requete);
            pst.setInt(1,p.getId());
            pst.executeUpdate();
            System.out.println("event supprimer");
        } catch (SQLException ex) {
            System.out.println(ex.getMessage());
        }



    }
    public ObservableList<Event> RECHERCHE(String title ) {
     
  
         ObservableList<Event> Produit = FXCollections.observableArrayList();
     
        String req = "select * from event where title LIKE '" + title + "%'  ";
       
        try {
            Statement st = cnx.createStatement();
            ResultSet resultat = st.executeQuery(req);
            
            while (resultat.next()){
                Event f= new Event();
                
                
              
             f.setStart(resultat.getDate("start"));
               f.setLieu(resultat.getString("lieu"));
               f.setImage(resultat.getString("image"));
               f.setTitle(resultat.getString("title"));
               f.setEnd(resultat.getDate("end"));
               f.setDescription(resultat.getString("description"));
               f.setCapacite(resultat.getString("capacite"));
                
               
                Produit.add(f);
            }
            
        } catch (SQLException ex) {
            Logger.getLogger(ServiceEvent.class.getName()).log(Level.SEVERE, null, ex);
        }
        return (Produit);
     }
    

     public ObservableList<Event> TriCapacite() {
     
  
         ObservableList<Event> Produit = FXCollections.observableArrayList();
        String req = "SELECT * FROM event ORDER BY capacite";
        try {
            Statement st = cnx.createStatement();
            ResultSet resultat = st.executeQuery(req);
            
            while (resultat.next()){
               Event f= new Event();
                 f.setStart(resultat.getDate("Start"));
               f.setLieu(resultat.getString("Lieu"));
               f.setImage(resultat.getString("Image"));
               f.setTitle(resultat.getString("Title"));
               f.setEnd(resultat.getDate("End"));
               f.setDescription(resultat.getString("Description"));
               f.setCapacite(resultat.getString("Capacite"));
              
            
                
               
                Produit.add(f);
            }
            
        } catch (SQLException ex) {
            Logger.getLogger(ServiceEvent.class.getName()).log(Level.SEVERE, null, ex);
        }
        return (Produit);
     }
     
     
//     
//     public void updateEvent(Event e,int id) {
//         try {
//            String requete = "UPDATE event SET `start`=?, `lieu`=?, `image`=?, `title`=? ,`end`=?,description`=?,`capacite`=? where `id`= "+id+" ";
//            Connection cnx;
//    PreparedStatement ste;
//            cnx = MaConnexion.getInstance().getCnx();
//           ste = cnx.prepareStatement(requete);
//          ste.setString(1,e.getStart());
//            ste.setString(2, e.getLieu());
//             ste.setString(3, e.getImage());
//              ste.setString(4, e.getTitle());
//               ste.setString(5, e.getEnd());
//                ste.setString(6, e.getDescription());
//                
//                   ste.setString(7, e.getCapacite());
//             ste.setInt(8, e.getId());
//            ste.executeUpdate();
//            System.out.println("event modifié");
//        } catch (SQLException ex) {
//            System.out.println(ex.getMessage());
//        }
//    }

  
}

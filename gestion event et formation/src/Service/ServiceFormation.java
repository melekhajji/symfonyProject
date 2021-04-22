
package Service;

import entites.Formation;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.ArrayList;
import java.util.List;
import java.util.logging.Level;
import java.util.logging.Logger;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;

import tools.MaConnexion;


public class ServiceFormation {
    Connection cnx = MaConnexion.getInstance().getCnx();

    public List<String> getAllEvent() {
        List<String> list = new ArrayList<String>();
        try {
            String requetee = "SELECT title FROM event";
            PreparedStatement pst = cnx.prepareStatement(requetee);
            ResultSet rs = pst.executeQuery();
            System.out.println(rs.toString());

            while (rs.next()) {
                list.add(rs.getString("title"));
            }

            return list;
        } catch (SQLException ex) {
            System.out.println(ex.getMessage());
        }
        return list;
    }

    public void ajouterFormation(Formation e) {
       
        try {
            int id = 0;

            String requete = "SELECT id FROM event  WHERE title=?";
            PreparedStatement pst = cnx.prepareStatement(requete);
            pst.setString(1, e.getEvent_id());
            ResultSet rs = pst.executeQuery();

            if (rs.next()) {
                id = rs.getInt(1);
            }

            String requetee = "INSERT INTO formation (nom,type,duree,prix,event_id) VALUES (?,?,?,?,?)";
            PreparedStatement pstt = cnx.prepareStatement(requetee);
            pstt.setString(1, e.getNom());
            pstt.setString(2, e.getType());
            pstt.setString(3,e.getDuree());
             pstt.setFloat(4,e.getPrix());
            pstt.setInt(5, id);
           

            System.out.println(e.getNom());
            System.out.println(e.getType());

            System.out.println(rs.getInt(1));
            System.out.println(e.getDuree());
            System.out.println(e.getPrix());

            pstt.executeUpdate();

          
            System.out.println("event ajouté !");
        } catch (SQLException ex) {
            if (ex.getMessage().contains("Duplicata")) {
                System.out.println("event existe deja!");
            } else {
                System.out.println(ex.getMessage());
            }
        }}
 
     public ObservableList<Formation> getAll() {
        String req = "SELECT p.id,p.nom,p.type,p.duree,p.prix,s.lieu FROM formation p  INNER JOIN event s on p.event_id=s.id ";

        ObservableList<Formation> list=FXCollections.observableArrayList();
        try {
           Statement st = cnx.createStatement();
            ResultSet rst = st.executeQuery(req);
           while(rst.next()){
               
              Formation f=new Formation(rst.getInt(1),rst.getString(2),rst.getString(3),rst.getString(4),rst.getFloat(5),rst.getString(6));
               list.add(f);
           }

        } catch (SQLException ex) {
            Logger.getLogger(ServiceFormation.class.getName()).log(Level.SEVERE, null, ex);
        }
        return list;
     
    }
     
     public ObservableList<Formation> getAllP(Float p) {
        String req = "SELECT p.id,p.nom,p.type,p.duree,p.prix,s.lieu FROM formation p  INNER JOIN event s on p.event_id=s.id where p.prix>'"+p+"' ";

        ObservableList<Formation> list=FXCollections.observableArrayList();
        try {
           Statement st = cnx.createStatement();
            ResultSet rst = st.executeQuery(req);
           while(rst.next()){
               
              Formation f=new Formation(rst.getInt(1),rst.getString(2),rst.getString(3),rst.getString(4),rst.getFloat(5),rst.getString(6));
               list.add(f);
           }

        } catch (SQLException ex) {
            Logger.getLogger(ServiceFormation.class.getName()).log(Level.SEVERE, null, ex);
        }
        return list;
     
    }
     
      public int getMax() {
        String req = "select max(prix) from formation";
        int a=-1;
        try {
           Statement ste = cnx.createStatement();
            ResultSet rst = ste.executeQuery(req);
   
           while(rst.next()){
              a= rst.getInt(1);
           }
           return a;
        } catch (SQLException ex) {
            Logger.getLogger(ServiceFormation.class.getName()).log(Level.SEVERE, null, ex);
            return -1;
        }
    }
     
 
    public ObservableList<Formation> getAllTrier() {
     
  
        
          String req = "SELECT p.id,p.nom,p.type,p.duree,p.prix,s.lieu FROM formation p  INNER JOIN event s on p.event_id=s.id order by p.prix DESC";

        ObservableList<Formation> list=FXCollections.observableArrayList();
        try {
           Statement st = cnx.createStatement();
            ResultSet rst = st.executeQuery(req);
           while(rst.next()){
               
              Formation f=new Formation(rst.getInt(1),rst.getString(2),rst.getString(3),rst.getString(4),rst.getFloat(5),rst.getString(6));
               list.add(f);
           }

        } catch (SQLException ex) {
            Logger.getLogger(ServiceFormation.class.getName()).log(Level.SEVERE, null, ex);
        }
        return list;
       
     }
     public ObservableList<Formation> RECHERCHE(String nom ) {
     
  
         ObservableList<Formation> Formation = FXCollections.observableArrayList();
     
        String req = "SELECT p.id,p.nom,p.type,p.duree,p.prix,s.lieu FROM formation p  INNER JOIN event s on p.event_id=s.id where p.nom LIKE '" + nom + "%'  ";
       

        ObservableList<Formation> list=FXCollections.observableArrayList();
        try {
           Statement st = cnx.createStatement();
            ResultSet rst = st.executeQuery(req);
           while(rst.next()){
               
              Formation f=new Formation(rst.getInt(1),rst.getString(2),rst.getString(3),rst.getString(4),rst.getFloat(5),rst.getString(6));
               list.add(f);
           }

        } catch (SQLException ex) {
            Logger.getLogger(ServiceFormation.class.getName()).log(Level.SEVERE, null, ex);
        }
        return list;
     }
     public void deleteFormation(Formation p) {
           try {
            String requete = "DELETE FROM formation WHERE id=?";
            PreparedStatement pst = MaConnexion.getInstance().getCnx()
                    .prepareStatement(requete);
            pst.setInt(1,p.getId());
            pst.executeUpdate();
            System.out.println("formation supprimer");
        } catch (SQLException ex) {
            System.out.println(ex.getMessage());
        }

    }
   
       public void updateFormation(int id,String nom,String type,String duree) {
         try {
            String requete = "UPDATE formation SET nom=?,type=?,duree=?  WHERE id = ?";
            PreparedStatement pst = MaConnexion.getInstance().getCnx()
                    .prepareStatement(requete);
            pst.setString(1,nom);
             pst.setNString(2, type);
           pst.setNString(3, duree);
           
         
      pst.setInt(4,id);
            
            pst.executeUpdate();
            System.out.println("formation modifié");
        } catch (SQLException ex) {
            System.out.println(ex.getMessage());
        }
    }
    
}

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package offrecrud;

import java.net.URL;
import java.util.Date;
import java.sql.Connection;
import java.sql.Statement;
import java.sql.ResultSet;
import java.sql.DriverManager;
import java.util.ResourceBundle;
import javafx.collections.FXCollections;
import javafx.event.ActionEvent;
import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.scene.control.Button;
import javafx.scene.control.DatePicker;
import javafx.scene.control.Label;
import javafx.scene.control.TableColumn;
import javafx.scene.control.TableView;
import javafx.scene.control.TextField;
import javafx.scene.control.cell.PropertyValueFactory;
import javafx.collections.ObservableList;

/**
 *
 * @author ASUS
 */
public class MainController implements Initializable {
    
    
    @FXML
    private TextField tfTitre;
    @FXML
    private TextField tfEntreprise;
    @FXML
    private TextField tfAdresse;
    @FXML
    private TextField tfPostesVacants;
    @FXML
    private TextField tfTypeContrat;
    @FXML
    private TextField tfExperience;
    @FXML
    private TextField tfRemuneration;
    @FXML
    private TextField tfLangues;
    @FXML
    private TextField tfDescription;
    @FXML
    private DatePicker dfDatexpiration;
    @FXML
    private TableView<Offre> tvOffres;
    @FXML
    private TableColumn<Offre, Integer> colId;
    @FXML
    private TableColumn<Offre, String> colTitre;
    @FXML
    private TableColumn<Offre, String> colEntreprise;
    @FXML
    private TableColumn<Offre, String> colAdresse;
    @FXML
    private TableColumn<Offre, String> colPostes;
    @FXML
    private TableColumn<Offre, String> colType;
    @FXML
    private TableColumn<Offre, String> colExperience;
    @FXML
    private TableColumn<Offre, String> colRemuneration;
    @FXML
    private TableColumn<Offre, String> colLangues;
    @FXML
    private TableColumn<Offre, String> colDescription;
    @FXML
    private TableColumn<Offre, Date> colDate;
    @FXML
    private Button btnAjouter;
    @FXML
    private Button btnModifier;
    @FXML
    private Button btnSupprimer;
    @FXML
    private TextField tfID;
    
    @FXML
    private void handleButtonAction(ActionEvent event) {
        if(event.getSource() == btnAjouter){
            insertOffre();
        }else if(event.getSource() == btnModifier){
        updateOffre(); 
    }else if(event.getSource() == btnSupprimer){
        deleteOffre();
    }
    }
    
    @Override
    public void initialize(URL url, ResourceBundle rb) {
        // TODO
        showOffre();
    }    
    
    public Connection getConnection(){
        Connection conn;
        try{
            conn = DriverManager.getConnection("jdbc:mysql://localhost:3306/offres?serverTimezone=UTC", "root", "");
            return conn;
        }catch(Exception ex){
            System.out.println("Error: " + ex.getMessage());
           return null;
        }
    }
    
    public ObservableList<Offre> getOffreList(){
        ObservableList<Offre> offreList = FXCollections.observableArrayList();
        Connection conn = getConnection();
        String query = "SELECT * FROM offre";
        Statement st;
        ResultSet rs;
        try{
            st = conn.createStatement();
            rs = st.executeQuery(query);
            Offre offre;
            while(rs.next()){
                offre = new Offre(rs.getInt("id"), rs.getString("Titre"), rs.getString("Entreprise"), rs.getString("Adresse"), rs.getString("Postes_Vacants"), rs.getString("Type_Contrat"),rs.getString("Experience"), rs.getString("Remuneration"), rs.getString("Langues"), rs.getString("Description"), rs.getString("Date_Expiration"));
                offreList.add(offre);
            }
        }catch(Exception ex){
            ex.printStackTrace();
        }
        return offreList;
    }
    
    public void showOffre(){
        ObservableList<Offre> list = getOffreList();
        
        colId.setCellValueFactory(new PropertyValueFactory<Offre, Integer>("id"));
        colTitre.setCellValueFactory(new PropertyValueFactory<Offre, String>("Titre"));
        colEntreprise.setCellValueFactory(new PropertyValueFactory<Offre, String>("Entreprise"));
        colAdresse.setCellValueFactory(new PropertyValueFactory<Offre, String>("Adresse"));
        colPostes.setCellValueFactory(new PropertyValueFactory<Offre, String>("Postes_Vacants"));
        colType.setCellValueFactory(new PropertyValueFactory<Offre, String>("Type_Contrat"));
        colExperience.setCellValueFactory(new PropertyValueFactory<Offre, String>("Experience"));
        colRemuneration.setCellValueFactory(new PropertyValueFactory<Offre, String>("Remuneration"));
        colLangues.setCellValueFactory(new PropertyValueFactory<Offre, String>("Langues"));
        colDescription.setCellValueFactory(new PropertyValueFactory<Offre, String>("Description"));
        colDate.setCellValueFactory(new PropertyValueFactory<Offre, Date>("Date_Expiration"));
        
        tvOffres.setItems(list);
    }
    private void insertOffre(){
        String query = "INSERT INTO offre VALUES(" + tfID.getText() + ",'" + tfTitre.getText() + "','" + tfEntreprise.getText() + "','" + tfAdresse.getText() + "','" + tfPostesVacants.getText() + "','" + tfTypeContrat.getText() + "','" + tfExperience.getText() + "','" + tfRemuneration.getText() + "','" + tfLangues.getText() + "','" + tfDescription.getText() + "'," + dfDatexpiration.getValue() + ")";
        executeQuery(query);
        showOffre();
    }
    
    private void updateOffre(){
        String query = "UPDATE offre SET Titre = '" + tfTitre.getText() + "', Entreprise = '" + tfEntreprise.getText() + "', Adresse = '" + tfAdresse.getText() + "', Postes_VACANTS = '" + tfPostesVacants.getText() + "', Type_Contrat = '" + tfTypeContrat.getText() + "', Experience = '" + tfExperience.getText() + "', Remuneration = '" + tfRemuneration.getText() + "', Langues = '" + tfLangues.getText() + "', Description = '" + tfDescription.getText() + "', Date_Expiration = " + dfDatexpiration.getValue() + " WHERE id = "  + tfID.getText() + "";
        executeQuery(query);
        showOffre();
    }
    
    private void deleteOffre(){
        String query ="Delete FROM offre WHERE id = " + tfID.getText() + "";
        executeQuery(query);
        showOffre();
    }

    private void executeQuery(String query) {
       Connection conn = getConnection();
       Statement st;
       try{
            st = conn.createStatement();
           st.executeUpdate(query);
       }catch(Exception ex){
           ex.printStackTrace();
       }
               
    }
}

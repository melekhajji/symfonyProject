/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package event;

import Service.ServiceEvent;
import com.itextpdf.text.DocumentException;
import entites.Pdf;
import java.awt.Desktop;
import java.io.File;
import java.io.FileNotFoundException;
import java.io.IOException;
import java.net.URL;
import java.sql.Date;
import java.sql.SQLException;
import java.util.Optional;
import java.util.ResourceBundle;
import javafx.collections.ObservableList;
import javafx.event.ActionEvent;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.fxml.Initializable;
import javafx.scene.Node;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.scene.control.Alert;
import javafx.scene.control.Button;
import javafx.scene.control.ButtonType;
import javafx.scene.control.TableColumn;
import javafx.scene.control.TableView;
import javafx.scene.control.TextField;
import javafx.scene.control.cell.PropertyValueFactory;
import javafx.scene.input.KeyEvent;
import javafx.scene.input.MouseEvent;
import javafx.scene.layout.AnchorPane;
import javafx.stage.Stage;

/**
 * FXML Controller class
 *
 * @author HP
 */
public class FrontEController implements Initializable {

    @FXML
    private AnchorPane front;
   
   @FXML
    private TableView<entites.Event> affiche;
    @FXML
    private TableColumn<entites.Event,Date> colstart;
    @FXML
    private TableColumn<entites.Event,String> collieu;
    @FXML
    private TableColumn<entites.Event,String> colimage;
    @FXML
    private TableColumn<entites.Event,String> coltitle;
    @FXML
    private TableColumn<entites.Event,Date> colend;
    @FXML
    private TableColumn<entites.Event,String> coldescription;
    @FXML
    private TableColumn<entites.Event,String>colcapacite;
    private TextField tfSearch1;
    @FXML
    private Button goh;
    @FXML
    private Button goE;
    @FXML
    private Button gotoF;
    @FXML
    private Button fermerbutton1;
    @FXML
    private TableColumn<?, ?> colidF1;
    @FXML
    private TextField tfSearch;
    @FXML
    private Button pdf;
    @FXML
    private Button tri;

    /**
     * Initializes the controller class.
     */
    @Override
    public void initialize(URL url, ResourceBundle rb) {
           ServiceEvent eventC = new ServiceEvent();
        
      affiche();
    }    
 public void affiche(){ 
        
      
          ObservableList<entites.Event> l = (ObservableList<entites.Event>) new ServiceEvent ().readEvent();
        
     
          colstart.setCellValueFactory(new PropertyValueFactory<entites.Event,Date>("start"));
      collieu.setCellValueFactory(new PropertyValueFactory<entites.Event, String>("lieu"));
      coltitle.setCellValueFactory(new PropertyValueFactory<entites.Event,String>("title"));
      colimage.setCellValueFactory(new PropertyValueFactory<entites.Event,String>("image"));
      colend.setCellValueFactory(new PropertyValueFactory<entites.Event,Date>("end")); 
      coldescription.setCellValueFactory(new PropertyValueFactory<entites.Event,String>("description"));
      colcapacite.setCellValueFactory(new PropertyValueFactory<entites.Event,String>("capacite"));
affiche.setItems(l);
    }
   

   @FXML
   private void getSelectedFilm(MouseEvent event) {
   }

   

         @FXML
    private void pdfOnAction(ActionEvent event) throws FileNotFoundException, SQLException, DocumentException {
       entites.Event tab_Recselected = affiche.getSelectionModel().getSelectedItem();

     
    Pdf p = new Pdf();
    p.add("Mon event",tab_Recselected.getLieu(),tab_Recselected.getImage(),tab_Recselected.getTitle(),tab_Recselected.getDescription(),tab_Recselected.getCapacite());
    
   try {
            String a;
            a = "C:\\Users\\HP\\Documents\\NetBeansProjects\\Event/Mon event";
            System.out.println(a);
        File file = new File(a);
        if (file.exists()){ 
        if(Desktop.isDesktopSupported()){
            Desktop.getDesktop().open(file);
        }}
    }
catch(Exception e){System.out.println("");}
    }
 
 @FXML
    private void tfSearchOnKeyRelese(KeyEvent event) {
        ServiceEvent eventC = new ServiceEvent();
        //refresh();
        //combo.setItems(FXCollections.observableArrayList(produitC.getAllType()));
        
                ObservableList<entites.Event> l = (ObservableList<entites.Event>) new ServiceEvent ().RECHERCHE(tfSearch.getText());

     
      colstart.setCellValueFactory(new PropertyValueFactory<entites.Event,Date>("start"));
      collieu.setCellValueFactory(new PropertyValueFactory<entites.Event, String>("lieu"));
      coltitle.setCellValueFactory(new PropertyValueFactory<entites.Event,String>("title"));
      colimage.setCellValueFactory(new PropertyValueFactory<entites.Event,String>("image"));
      colend.setCellValueFactory(new PropertyValueFactory<entites.Event,Date>("end")); 
      coldescription.setCellValueFactory(new PropertyValueFactory<entites.Event,String>("description"));
      colcapacite.setCellValueFactory(new PropertyValueFactory<entites.Event,String>("capacite"));
        
affiche.setItems(l);
        
      

    }

    @FXML
    private void triOnAction(ActionEvent event) throws SQLException {
        
        ServiceEvent eventC = new ServiceEvent();
    
          
        ObservableList<entites.Event> l = (ObservableList<entites.Event>) new ServiceEvent ().TriCapacite();
         colstart.setCellValueFactory(new PropertyValueFactory<entites.Event,Date>("start"));
      collieu.setCellValueFactory(new PropertyValueFactory<entites.Event, String>("lieu"));
      coltitle.setCellValueFactory(new PropertyValueFactory<entites.Event,String>("title"));
      colimage.setCellValueFactory(new PropertyValueFactory<entites.Event,String>("image"));
      colend.setCellValueFactory(new PropertyValueFactory<entites.Event,Date>("end")); 
      coldescription.setCellValueFactory(new PropertyValueFactory<entites.Event,String>("description"));
      colcapacite.setCellValueFactory(new PropertyValueFactory<entites.Event,String>("capacite"));
        
affiche.setItems(l);
        
         
        
    }

  

    
  @FXML
    private void fermer () {
                Alert alert =new Alert (Alert.AlertType.CONFIRMATION);
                alert.setTitle("Confirmation") ;
                alert.setHeaderText("Voulez vous fermer la fenêtre?") ;
                Optional <ButtonType> result=alert.showAndWait();
                if (result.get()==ButtonType.OK)
                {
                    Stage stage =(Stage) fermerbutton1.getScene().getWindow() ;
                    stage.close() ;
        
    }
    }
 @FXML
    private void gotoEvent(ActionEvent event)throws IOException {
         Parent root = FXMLLoader.load(getClass().getResource("FrontE.fxml"));
              Scene scene = new Scene(root);
              Stage stage = (Stage) ((Node) event.getSource()).getScene().getWindow();
              stage.setScene(scene);
              stage.show();
    }

    @FXML
    private void gotoFormation(ActionEvent event)throws IOException {
          Parent root = FXMLLoader.load(getClass().getResource("front.fxml"));
              Scene scene = new Scene(root);
              Stage stage = (Stage) ((Node) event.getSource()).getScene().getWindow();
              stage.setScene(scene);
              stage.show();
    }

    @FXML
    private void gotoHome(ActionEvent event) throws IOException  { 
      
              Parent root = FXMLLoader.load(getClass().getResource("FrontG.fxml"));
              Scene scene = new Scene(root);
              Stage stage = (Stage) ((Node) event.getSource()).getScene().getWindow();
              stage.setScene(scene);
              stage.show();
    }
    

   
    
}

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package event;
import entites.Event;
import Service.ServiceEvent;
import java.io.IOException;
import java.net.URL;
import java.sql.Connection;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import static java.time.zone.ZoneRulesProvider.refresh;
import java.util.Optional;
import java.util.ResourceBundle;
import javafx.collections.ObservableList;
import javafx.event.ActionEvent;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.fxml.Initializable;
import javafx.print.PrinterJob;
import javafx.scene.Parent;
import javafx.scene.control.Alert;
import javafx.scene.control.Alert.AlertType;
import javafx.scene.control.Button;
import javafx.scene.control.ButtonType;
import javafx.scene.control.Label;
import javafx.scene.control.TableColumn;
import javafx.scene.control.TableView;
import javafx.scene.control.TextArea;
import javafx.scene.control.TextField;
import javafx.scene.control.cell.PropertyValueFactory;
import javafx.scene.image.ImageView;
import javafx.scene.input.KeyEvent;
import javafx.scene.input.MouseEvent;
import javafx.stage.Stage;
import javax.swing.JOptionPane;
import tools.MaConnexion;

/**
 *
 * @author HP
 */
public class FXMLDocumentController implements Initializable {
    
    private Label label;
    @FXML
    private TableView<Event> affiche;
    @FXML
    private TableColumn<Event,String > colidF;
    @FXML
    private TableColumn<Event,String> colstart;
    @FXML
    private TableColumn<Event,String> collieu;
    @FXML
    private TableColumn<Event,String> colimage;
    @FXML
    private TableColumn<Event,String> coltitle;
    @FXML
    private TableColumn<Event,String> colend;
    @FXML
    private TableColumn<Event,String> coldescription;
    @FXML
    private TableColumn<Event,Integer>colcapacite;
    @FXML
    private TextField lieu;
    @FXML
    private TextField image;
    @FXML
    private TextField start;
    @FXML
    private TextField capacite;
    @FXML
    private TextField end;
    @FXML
    private TextArea desc;
    @FXML
    private Label lblHeader;
    @FXML
    private Button btnAjouter;
    @FXML
    private TextField title;
    @FXML
    private Button btnDelete;
    @FXML
    private TextField tfSearch;
    @FXML
    private Button tri;
    @FXML
    private Button pdf;
    @FXML
    private Label labell;
    @FXML
    private Button btnimprimerevent;
    @FXML
    private Button fermerbutton1;
  
    private Button id;
    private void handleButtonAction(ActionEvent event) {
        System.out.println("You clicked me!");
        label.setText("Hello World!");
    }
    
    @Override
    public void initialize(URL url, ResourceBundle rb) {
       ServiceEvent eventC = new ServiceEvent();
        refresh();
       
        ObservableList<Event> l = (ObservableList<Event>) new ServiceEvent ().readEvent();
        
     
          colstart.setCellValueFactory(new PropertyValueFactory<>("start"));
      collieu.setCellValueFactory(new PropertyValueFactory<>("lieu"));
      coltitle.setCellValueFactory(new PropertyValueFactory<>("title"));
      colimage.setCellValueFactory(new PropertyValueFactory<>("image"));
      colend.setCellValueFactory(new PropertyValueFactory<>("end")); 
      coldescription.setCellValueFactory(new PropertyValueFactory<>("description"));
      colcapacite.setCellValueFactory(new PropertyValueFactory<>("capacite"));
        
affiche.setItems(l);
  
        
       
    }    

    @FXML
    private void getSelectedFilm(MouseEvent event) {
    }

    @FXML
    private void ajouterEventOnAction(ActionEvent event) {
        
        
          String startt = start.getText();
        String lieuu = lieu.getText();
        String imagee = image.getText();
        String titlee = title.getText();
        String endd = end.getText();
 String descriptionn = desc.getText();
Integer capacitee=Integer.parseInt(capacite.getText());  
ServiceEvent eventC = new ServiceEvent();
        Event e = new Event(startt, lieuu, imagee, titlee,endd,descriptionn,capacitee);

       eventC.ajouterEvent(e);
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
    }

    @FXML
    private void btnDeleteOnAction(ActionEvent event) {
        if (!affiche.getSelectionModel().isEmpty()) {
        Alert alert = new Alert(AlertType.CONFIRMATION, "Etes vous sur de vouloir supprimer ce " + affiche.getSelectionModel().getSelectedItem().getTitle() + " ?", ButtonType.YES, ButtonType.NO);
alert.showAndWait();

if (alert.getResult() == ButtonType.YES) {
    ServiceEvent cp = new ServiceEvent();
    cp. deleteEvent(affiche.getSelectionModel().getSelectedItem());
   
}

        }
    }


    @FXML
    private void tfSearchOnKeyRelese(KeyEvent event) {
        ServiceEvent eventC = new ServiceEvent();
        //refresh();
        //combo.setItems(FXCollections.observableArrayList(produitC.getAllType()));
        
                ObservableList<Event> l = (ObservableList<Event>) new ServiceEvent ().RECHERCHE(tfSearch.getText());

     
     
          colstart.setCellValueFactory(new PropertyValueFactory<>("start"));
      collieu.setCellValueFactory(new PropertyValueFactory<>("lieu"));
      coltitle.setCellValueFactory(new PropertyValueFactory<>("title"));
      colimage.setCellValueFactory(new PropertyValueFactory<>("image"));
      colend.setCellValueFactory(new PropertyValueFactory<>("end")); 
      coldescription.setCellValueFactory(new PropertyValueFactory<>("description"));
      colcapacite.setCellValueFactory(new PropertyValueFactory<>("capacite"));
        
affiche.setItems(l);
        
      

    }

    @FXML
    private void triOnAction(ActionEvent event) throws SQLException {
        
        ServiceEvent eventC = new ServiceEvent();
        refresh();
          
        ObservableList<Event> l = (ObservableList<Event>) new ServiceEvent ().TriCapacite();
        colstart.setCellValueFactory(new PropertyValueFactory<>("start"));
      collieu.setCellValueFactory(new PropertyValueFactory<>("lieu"));
      coltitle.setCellValueFactory(new PropertyValueFactory<>("title"));
      colimage.setCellValueFactory(new PropertyValueFactory<>("image"));
      colend.setCellValueFactory(new PropertyValueFactory<>("end")); 
      coldescription.setCellValueFactory(new PropertyValueFactory<>("description"));
      colcapacite.setCellValueFactory(new PropertyValueFactory<>("capacite"));
        
        
affiche.setItems(l);
        
        
        
    }

    @FXML
    private void btnPdfOnAction(ActionEvent event) {
        
        FXMLLoader loader = new FXMLLoader(getClass().getResource("AjoutE.fxml"));
        try {
            Parent root = loader.load();
      AjoutEController apc = loader.getController();
           affiche.getScene().setRoot(root);
        } catch (IOException ex) {
            System.out.println(ex.getMessage());
        }
    }

    @FXML
    private void Imprimer(ActionEvent event) {
    
        
      ServiceEvent ff = new ServiceEvent();
        try {
            labell.setText(ff.readEvent().toString());
            PrinterJob job = PrinterJob.createPrinterJob();
            
            if(job != null)
            {
                job.printPage(labell);
                job.endJob();
            }
        } catch (Exception e) {
            System.out.println(e.getMessage());
        }
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
    private void Modifierevent(ActionEvent event) throws SQLException {
        
        
 Integer idd=Integer.parseInt(id.getText());  
 
          String startt = start.getText();
        String lieuu = lieu.getText();
        String imagee = image.getText();
        String titlee = title.getText();
        String endd = end.getText();
 String descriptionn = desc.getText();
Integer capacitee=Integer.parseInt(capacite.getText());  
ServiceEvent eventC = new ServiceEvent();
        Event e = new Event(startt, lieuu, imagee, titlee,endd,descriptionn,capacitee);

       eventC.updateEvent(e,idd);
        
            
       
        
        
        
    }

    
    
}

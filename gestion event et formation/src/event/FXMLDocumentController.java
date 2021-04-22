/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package event;
import entites.Event;
import Service.ServiceEvent;
import com.itextpdf.text.DocumentException;
import entites.Pdf;
import java.awt.Desktop;
import java.io.File;
import java.io.FileNotFoundException;
import java.io.IOException;
import java.net.URL;
import java.nio.file.Files;
import java.sql.Connection;
import java.sql.Date;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.text.DateFormat;
import java.text.SimpleDateFormat;
import java.time.Duration;
import static java.time.zone.ZoneRulesProvider.refresh;
import java.util.Optional;
import java.util.ResourceBundle;
import javafx.collections.ObservableList;
import javafx.event.ActionEvent;
import javafx.event.EventHandler;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.fxml.Initializable;
import javafx.geometry.Pos;
import javafx.print.PrinterJob;
import javafx.scene.Node;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.scene.control.Alert;
import javafx.scene.control.Alert.AlertType;
import javafx.scene.control.Button;
import javafx.scene.control.ButtonType;
import javafx.scene.control.DatePicker;
import javafx.scene.control.Label;
import javafx.scene.control.TableColumn;
import javafx.scene.control.TableView;
import javafx.scene.control.TextArea;
import javafx.scene.control.TextField;
import javafx.scene.control.cell.PropertyValueFactory;
import javafx.scene.image.ImageView;
import javafx.scene.input.KeyEvent;
import javafx.scene.input.MouseEvent;
import javafx.scene.layout.AnchorPane;
import javafx.stage.FileChooser;
import javafx.stage.Stage;
import javafx.stage.StageStyle;
import javax.swing.JOptionPane;
import org.controlsfx.control.Notifications;
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
    private TableColumn<Event,Date> colstart;
    @FXML
    private TableColumn<Event,String> collieu;
    @FXML
    private TableColumn<Event,String> colimage;
    @FXML
    private TableColumn<Event,String> coltitle;
    @FXML
    private TableColumn<Event,Date> colend;
    @FXML
    private TableColumn<Event,String> coldescription;
    @FXML
    private TableColumn<Event,String>colcapacite;
    @FXML
    private TextField lieu;
    @FXML
    private Button image;
    @FXML
    private DatePicker start;
    @FXML
    private TextField capacite;
    @FXML
    private DatePicker end;
    @FXML
    private TextArea desc;
    @FXML
    private Button btnAjouter;
    @FXML
    private TextField title;
    @FXML
    private TextField tfSearch;
    @FXML
    private Button fermerbutton1;
  
    private Button id;
    private AnchorPane panemenu;
    @FXML
    private AnchorPane paneTraitement;
    @FXML
    private TableColumn<?, ?> colidF;
    @FXML
    private Button r1;
    @FXML
    private Button pdf;
    @FXML
    private Button tri;
    @FXML
    private Label lblHeader;
    @FXML
    private Button btnDelete;
    @FXML
    private Button btnF1;
    @FXML
    private Button interfaceE1;
    @FXML
    private Button Bt_Dashboard2111111;
    @FXML
    private Button Bt_Dashboard2111121;
    @FXML
    private Button Bt_Dashboard2111131;
    @FXML
    private Button Bt_Dashboard2111141;
    @FXML
    private Button front21;
     @Override
    public void initialize(URL url, ResourceBundle rb) {
       ServiceEvent eventC = new ServiceEvent();
        
      affiche();    
       
    }    
    
    private void handleButtonAction(ActionEvent event) {
        System.out.println("You clicked me!");
        label.setText("Hello World!");
    }
    public void affiche(){ 
        
      
          ObservableList<Event> l = (ObservableList<Event>) new ServiceEvent ().readEvent();
        
     
          colstart.setCellValueFactory(new PropertyValueFactory<Event,Date>("start"));
      collieu.setCellValueFactory(new PropertyValueFactory<Event, String>("lieu"));
      coltitle.setCellValueFactory(new PropertyValueFactory<Event,String>("title"));
      colimage.setCellValueFactory(new PropertyValueFactory<Event,String>("image"));
      colend.setCellValueFactory(new PropertyValueFactory<Event,Date>("end")); 
      coldescription.setCellValueFactory(new PropertyValueFactory<Event,String>("description"));
      colcapacite.setCellValueFactory(new PropertyValueFactory<Event,String>("capacite"));
affiche.setItems(l);
    }
   

    @FXML
    private void getSelectedFilm(MouseEvent event) {
    }

    @FXML
    private void ajouterEventOnAction(ActionEvent event) {
        
         
                                            
    
          Date startt=Date.valueOf(start.getValue());
        String lieuu = lieu.getText();
        String imagee = image.getText();
        String titlee = title.getText();
       
          Date endd=Date.valueOf(end.getValue());
 String descriptionn = desc.getText();
 String capacitee =capacite.getText();  
ServiceEvent eventC = new ServiceEvent();
        Event e = new Event(startt, lieuu, imagee, titlee,endd,descriptionn,capacitee);

        if (lieuu.isEmpty()) {
            Alert alert = new Alert(Alert.AlertType.ERROR);
            alert.setHeaderText(null);
            alert.setContentText("Please Fill All DATA");
            alert.showAndWait();

        }
         else if (imagee.isEmpty()) {
            Alert alert = new Alert(Alert.AlertType.ERROR);
            alert.setHeaderText(null);
            alert.setContentText("Please Fill All DATA");
            alert.showAndWait();

        }
           else if (titlee.isEmpty()) {
            Alert alert = new Alert(Alert.AlertType.ERROR);
            alert.setHeaderText(null);
            alert.setContentText("Please Fill All DATA");
            alert.showAndWait();

        }
             else if (capacitee.isEmpty()) {
            Alert alert = new Alert(Alert.AlertType.ERROR);
            alert.setHeaderText(null);
            alert.setContentText("Please Fill All DATA");
            alert.showAndWait();

        }
               else if (descriptionn.isEmpty()) {
            Alert alert = new Alert(Alert.AlertType.ERROR);
            alert.setHeaderText(null);
            alert.setContentText("Please Fill All DATA");
            alert.showAndWait();

        }
        else{ 
             Alert alert =new Alert (Alert.AlertType.CONFIRMATION);
                alert.setTitle("Confirmation") ;
                alert.setHeaderText("Voulez-vous ajouter un Event?") ;
            
            
            Optional <ButtonType> result=alert.showAndWait();
                if (result.get()==ButtonType.OK)
                {
                    Stage stage =(Stage) btnAjouter.getScene().getWindow() ;
                  JOptionPane.showMessageDialog(null, "Event Ajouté");
             
             eventC.ajouterEvent(e);
                }
           
        Notifications notificationBuild = Notifications.create()
                                      .title("Traitement Event")
                                      .text("l'evennement a été ajouté avec succes")
                                      .graphic(null)
                                      //.hideAfter(Duration.Hours(5))
                                      .position(Pos.CENTER)
                                      .onAction(new EventHandler<ActionEvent>() {
                                  @Override
                                  public void handle(ActionEvent event) {
                                      System.out.println("click here");
                                  }
                                  
                              });
                              notificationBuild.show();
        
         affiche();}
        
        
        
  
        
    }

    @FXML
    private void btnDeleteOnAction(ActionEvent event) {
        if (!affiche.getSelectionModel().isEmpty()) {
        Alert alert = new Alert(AlertType.CONFIRMATION, "Etes vous sur de vouloir supprimer ce " + affiche.getSelectionModel().getSelectedItem().getTitle() + " ?", ButtonType.YES, ButtonType.NO);
alert.showAndWait();

if (alert.getResult() == ButtonType.YES) {
    ServiceEvent cp = new ServiceEvent();
    
    cp. deleteEvent(affiche.getSelectionModel().getSelectedItem());
    affiche();
   
}

        }
           else {
                Alert alert = new Alert(Alert.AlertType.WARNING);
                alert.setTitle("Selectionner");
                alert.setHeaderText(null);
                alert.setContentText("Selectionner une ligne ");
                alert.showAndWait();
            }
            
        
    }


    @FXML
    private void tfSearchOnKeyRelese(KeyEvent event) {
        ServiceEvent eventC = new ServiceEvent();
        //refresh();
        //combo.setItems(FXCollections.observableArrayList(produitC.getAllType()));
        
                ObservableList<Event> l = (ObservableList<Event>) new ServiceEvent ().RECHERCHE(tfSearch.getText());

     
      colstart.setCellValueFactory(new PropertyValueFactory<Event,Date>("start"));
      collieu.setCellValueFactory(new PropertyValueFactory<Event, String>("lieu"));
      coltitle.setCellValueFactory(new PropertyValueFactory<Event,String>("title"));
      colimage.setCellValueFactory(new PropertyValueFactory<Event,String>("image"));
      colend.setCellValueFactory(new PropertyValueFactory<Event,Date>("end")); 
      coldescription.setCellValueFactory(new PropertyValueFactory<Event,String>("description"));
      colcapacite.setCellValueFactory(new PropertyValueFactory<Event,String>("capacite"));
        
affiche.setItems(l);
        
      

    }

    @FXML
    private void triOnAction(ActionEvent event) throws SQLException {
        
        ServiceEvent eventC = new ServiceEvent();
    
          
        ObservableList<Event> l = (ObservableList<Event>) new ServiceEvent ().TriCapacite();
         colstart.setCellValueFactory(new PropertyValueFactory<Event,Date>("start"));
      collieu.setCellValueFactory(new PropertyValueFactory<Event, String>("lieu"));
      coltitle.setCellValueFactory(new PropertyValueFactory<Event,String>("title"));
      colimage.setCellValueFactory(new PropertyValueFactory<Event,String>("image"));
      colend.setCellValueFactory(new PropertyValueFactory<Event,Date>("end")); 
      coldescription.setCellValueFactory(new PropertyValueFactory<Event,String>("description"));
      colcapacite.setCellValueFactory(new PropertyValueFactory<Event,String>("capacite"));
        
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
    private void Modifierevent(ActionEvent event) throws SQLException {
        
        boolean choix = affiche.getSelectionModel().isEmpty();


            if(!choix) {
            Alert alert = new Alert(Alert.AlertType.CONFIRMATION);
            alert.setTitle("Confirmation de votre modification ");
            alert.setHeaderText(null);
            alert.setContentText("Voulez-vous vraiment de modifier cette ligne ??");
            
            Optional<ButtonType> action = alert.showAndWait();

            if (action.get() == ButtonType.OK) {


                try {

                    FXMLLoader loader = new FXMLLoader();
                    loader.setLocation(getClass().getResource("/event/update.fxml"));
                    loader.load();

                    Event tab2 = affiche.getSelectionModel().getSelectedItem();
                   UpdateController updateController = loader.getController();


                    updateController.fonction ( tab2.getId() , tab2.getEnd() , tab2.getImage() , tab2.getCapacite() , tab2.getLieu() , tab2.getStart() , tab2.getTitle() , tab2.getDescription() );

                    Parent parent = loader.getRoot();
                    Scene scene = new Scene(parent);
                    Stage stage = new Stage();
                    stage.setScene(scene);
                    stage.initStyle(StageStyle.UTILITY);
                    stage.show();

                } catch (IOException ex) {
                    System.out.println(ex);
                }
            }
        }  else if (choix) {
                Alert alert = new Alert(Alert.AlertType.WARNING);
                alert.setTitle("Selectionner");
                alert.setHeaderText(null);
                alert.setContentText("Selectionner une ligne ");
                alert.showAndWait();
            }
            
         affiche();

    }

        
        
        
    

    @FXML
    private void upload(ActionEvent event) {
        Stage primary = new Stage();
FileChooser fileChooser = new FileChooser();
fileChooser.setTitle("Selectionner une image");
fileChooser.getExtensionFilters().addAll(new FileChooser.ExtensionFilter("image Files", "*.png", "*.jpg", "*.gif", "*.jpeg"));
File file = fileChooser.showOpenDialog(primary);
String path = "C:\\Users\\HP\\Documents\\NetBeansProjects\\Event\\src\\Image";
image.setText(file.getPath());
String m = file.getPath();

if (file != null) {
try{
Files.copy(file.toPath(), new File(path + "\\" + file.getName()).toPath());

    System.out.println(m);
}catch (Exception e) {
e.printStackTrace();
}
}
    }

    @FXML
    private void refresh(ActionEvent event) {
affiche();     }

    @FXML
        private void retourmenu(ActionEvent event) throws IOException {
          Parent root = FXMLLoader.load(getClass().getResource("back.fxml"));
              Scene scene = new Scene(root);
              Stage stage = (Stage) ((Node) event.getSource()).getScene().getWindow();
              stage.setScene(scene);
              stage.show();  
    }

      
    
    
    @FXML
    private void interfaceevent(ActionEvent event) throws IOException  {
      Parent root = FXMLLoader.load(getClass().getResource("FXMLDocument.fxml"));
              Scene scene = new Scene(root);
              Stage stage = (Stage) ((Node) event.getSource()).getScene().getWindow();
              stage.setScene(scene);
              stage.show();
    }

//    private void evOnAction(ActionEvent event) {
//           paneTraitement.setVisible(false);
//        panemenu2.setVisible(true);
//          panemenu.setVisible(false);  
//    }

    private void retour2(ActionEvent event) throws IOException {
          Parent root = FXMLLoader.load(getClass().getResource("back.fxml"));
              Scene scene = new Scene(root);
              Stage stage = (Stage) ((Node) event.getSource()).getScene().getWindow();
              stage.setScene(scene);
              stage.show();  
    }

  

         @FXML
    private void pdfOnAction(ActionEvent event) throws FileNotFoundException, SQLException, DocumentException {
       Event tab_Recselected = affiche.getSelectionModel().getSelectedItem();

     
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
    private void interfaceformation(ActionEvent event)throws IOException  { 
        Parent root = FXMLLoader.load(getClass().getResource("Formation.fxml"));
              Scene scene = new Scene(root);
              Stage stage = (Stage) ((Node) event.getSource()).getScene().getWindow();
              stage.setScene(scene);
              stage.show();
       
    }

    @FXML
    private void front2(ActionEvent event) throws IOException  {
          Parent root = FXMLLoader.load(getClass().getResource("FrontG.fxml"));
              Scene scene = new Scene(root);
              Stage stage = (Stage) ((Node) event.getSource()).getScene().getWindow();
              stage.setScene(scene);
              stage.show();
    }

   

    
    
}

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package event;
import entites.Formation;

import Service.ServiceFormation;
import com.itextpdf.text.DocumentException;
import entites.Pdf;
import entites.Pdf2;
import java.awt.Desktop;
import java.io.File;
import java.io.FileNotFoundException;
import java.io.FileNotFoundException;
import java.io.IOException;
import java.net.URL;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.Optional;
import java.util.ResourceBundle;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.event.ActionEvent;
import javafx.event.EventHandler;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.fxml.Initializable;
import javafx.geometry.Pos;
import javafx.scene.Node;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.scene.chart.PieChart;
import javafx.scene.control.Alert;
import javafx.scene.control.Alert.AlertType;
import javafx.scene.control.Button;
import javafx.scene.control.ButtonType;
import javafx.scene.control.ComboBox;
import javafx.scene.control.Label;
import javafx.scene.control.TableColumn;
import javafx.scene.control.TableView;
import javafx.scene.control.TextField;
import javafx.scene.control.cell.PropertyValueFactory;
import javafx.scene.input.KeyEvent;
import javafx.scene.input.MouseEvent;
import javafx.scene.layout.AnchorPane;
import javafx.stage.Stage;
import tools.MaConnexion;
import javafx.scene.chart.PieChart;
import javafx.scene.chart.PieChart.Data;
import javafx.scene.chart.XYChart;
import org.controlsfx.control.Notifications;
/**
 * FXML Controller class
 *
 * @author HP
 */
public class FormationController implements Initializable {

    @FXML
    private AnchorPane paneTraitementF;
    @FXML
    private Label labell;
    @FXML
    private TableView<Formation> affiche;
    @FXML
    private TableColumn<Formation, String> colnom;
    @FXML
    private TableColumn<Formation, String> colidF;
    @FXML
    private TableColumn<Formation, String> coltype;
    @FXML
    private TableColumn<Formation, String> colduree;
    @FXML
    private TableColumn<Formation, Float> colprix;
    @FXML
    private TableColumn<Formation, String> colevent;
    @FXML
    private TextField duree;
    @FXML
    private TextField type;
    @FXML
    private TextField nom;
    @FXML
    private TextField prix;
      @FXML
    private ComboBox<String> combo;
   
    @FXML
    private Button r1;
    @FXML
    private Button fermerbutton1;
    @FXML
    private Button btnAjouter;
    @FXML
    private Button btnDelete;
    @FXML
    private Button btnUpdate;
    @FXML
    private Button pdf1;
    @FXML
    private Button tri;
    @FXML
    private TextField tfSearch;
    @FXML
    private TextField id;
    @FXML
    private Button select;
    @FXML
    private PieChart piechart;
     ObservableList<PieChart.Data> piechartdata;
    @FXML
    private Button front;
    @FXML
    private Button btnF;
    @FXML
    private Button interfaceE;
    @FXML
    private Button Bt_Dashboard211111;
    @FXML
    private Button Bt_Dashboard211112;
    @FXML
    private Button Bt_Dashboard211113;
    @FXML
    private Button Bt_Dashboard211114;
    @FXML
    private Button front2;
    @FXML
    private Label lblHeader1;
    @FXML
    private Label lblHeader11;
 
 public void affiche(){ 
        
  
 ObservableList<Formation> l = (ObservableList<Formation>) new ServiceFormation ().getAll();        
    
          colnom.setCellValueFactory(new PropertyValueFactory<Formation,String>("nom"));
      coltype.setCellValueFactory(new PropertyValueFactory<Formation, String>("type"));
      colduree.setCellValueFactory(new PropertyValueFactory<Formation,String>("duree"));
     colprix.setCellValueFactory(new PropertyValueFactory<Formation,Float>("prix"));;
             colevent.setCellValueFactory(new PropertyValueFactory<Formation,String>("event_id"));

affiche.setItems(l);
  refresh2();
    }
 
   
    @Override
    public void initialize(URL url, ResourceBundle rb) {
 piechart.setData(piechartdata);
       Stat();
   
         ServiceFormation formation = new ServiceFormation();
          refresh2();
      
    ObservableList<Formation> l = (ObservableList<Formation>) new ServiceFormation ().getAll();        
     combo.setItems(FXCollections.observableArrayList(formation.getAllEvent()));
          colnom.setCellValueFactory(new PropertyValueFactory<Formation,String>("nom"));
      coltype.setCellValueFactory(new PropertyValueFactory<Formation, String>("type"));
      colduree.setCellValueFactory(new PropertyValueFactory<Formation,String>("duree"));
     colprix.setCellValueFactory(new PropertyValueFactory<Formation,Float>("prix"));;
             colevent.setCellValueFactory(new PropertyValueFactory<Formation,String>("event_id"));

affiche.setItems(l);
       
     
    }    
    

 @FXML
    private void tfSearchOnKeyRelese(KeyEvent event) {
                 ServiceFormation formation = new ServiceFormation();
                ObservableList<Formation> l = (ObservableList<Formation>) new ServiceFormation ().RECHERCHE(tfSearch.getText());
 colnom.setCellValueFactory(new PropertyValueFactory<Formation,String>("nom"));
      coltype.setCellValueFactory(new PropertyValueFactory<Formation, String>("type"));
      colduree.setCellValueFactory(new PropertyValueFactory<Formation,String>("duree"));
     colprix.setCellValueFactory(new PropertyValueFactory<Formation,Float>("prix"));;
             colevent.setCellValueFactory(new PropertyValueFactory<Formation,String>("event_id"));
             affiche.setItems(l);
    }


    

    @FXML
    private void retourmenu(ActionEvent event)    throws IOException 
{
       
   
          Parent root = FXMLLoader.load(getClass().getResource("back.fxml"));
              Scene scene = new Scene(root);
              Stage stage = (Stage) ((Node) event.getSource()).getScene().getWindow();
              stage.setScene(scene);
              stage.show();  
    
    }

    @FXML
    private void refresh(ActionEvent event) {
        affiche();
         refresh2();
    }

    @FXML
    private void fermer(ActionEvent event) {
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
    private void ajouterFormationOnAction(ActionEvent event) {
           String nomm = nom.getText();
        String typee = type.getText();
        String dureee = duree.getText();
       Float p=Float.parseFloat(prix.getText());
 
    String eventt = combo.getValue();
     

               ServiceFormation formation = new ServiceFormation();

        Formation e = new Formation(nomm,typee,dureee,p,eventt);

        if (nomm.isEmpty()) {
            Alert alert = new Alert(Alert.AlertType.ERROR);
            alert.setHeaderText(null);
            alert.setContentText("Please Fill All DATA");
            alert.showAndWait();}
        else if(typee.isEmpty()){
               Alert alert = new Alert(Alert.AlertType.ERROR);
            alert.setHeaderText(null);
            alert.setContentText("Please Fill All DATA");
            alert.showAndWait();  }
             else if(dureee.isEmpty()){
               Alert alert = new Alert(Alert.AlertType.ERROR);
            alert.setHeaderText(null);
            alert.setContentText("Please Fill All DATA");
            alert.showAndWait();  }    
               
                
                
        else{
                  Alert alert = new Alert(AlertType.CONFIRMATION, "Etes vous sur de vouloir ajouter ceette formation "  + " ?", ButtonType.YES, ButtonType.NO);
alert.showAndWait();


if (alert.getResult() == ButtonType.YES) {
        formation.ajouterFormation(e);
         affiche();
             Notifications notificationBuild = Notifications.create()
                                      .title("Traitement Formation")
                                      .text("la formation a été ajouté avec succes")
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
             }}

    }

    @FXML
    private void btnDeleteFormationOnAction(ActionEvent event) {
        
         if (!affiche.getSelectionModel().isEmpty()) {
        Alert alert = new Alert(AlertType.CONFIRMATION, "Etes vous sur de vouloir supprimer ce " + affiche.getSelectionModel().getSelectedItem().getNom() + " ?", ButtonType.YES, ButtonType.NO);
alert.showAndWait();

if (alert.getResult() == ButtonType.YES) {
     ServiceFormation cp = new ServiceFormation();
    cp.deleteFormation(affiche.getSelectionModel().getSelectedItem());
     Notifications notificationBuild = Notifications.create()
                                      .title("Traitement Formation")
                                      .text("la formation a été supprimé avec succes")
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
    affiche();
}
 
        }
         else{
              Alert alert = new Alert(Alert.AlertType.ERROR);
            alert.setHeaderText(null);
            alert.setContentText("il faut séléctionner une ligne");
            alert.showAndWait();}
        
 
        
    }

    @FXML
    private void btnUpdateOnAction(ActionEvent event) {
          int idd = Integer.parseInt(id.getText());
        
         String nomm = nom.getText();
        String typee = type.getText();
      String dureee = duree.getText();
     ServiceFormation s = new   ServiceFormation();
       
        s.updateFormation(idd,nomm,typee,dureee);
         Notifications notificationBuild = Notifications.create()
                                      .title("Traitement Formation")
                                      .text("la formation a été modifié avec succes")
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
        affiche();
    }

    @FXML
     private void pdfOnAction2(ActionEvent event) throws FileNotFoundException, SQLException, DocumentException, IOException {
     

         Formation tab_Recselected = affiche.getSelectionModel().getSelectedItem();

       String Var_prix = String.valueOf(tab_Recselected.getPrix());

    Pdf2 p = new Pdf2();
    p.add("Ma Formation",tab_Recselected.getNom(),tab_Recselected.getType(),tab_Recselected.getDuree(),Var_prix);
    
   try {
            String a;
            a = "C:\\Users\\HP\\Documents\\NetBeansProjects\\Event/Ma Formation";
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
    private void triOnAction(ActionEvent event) {
        
        
        
         ObservableList<Formation> l = (ObservableList<Formation>) new ServiceFormation ().getAllTrier();        
     
          colnom.setCellValueFactory(new PropertyValueFactory<Formation,String>("nom"));
      coltype.setCellValueFactory(new PropertyValueFactory<Formation, String>("type"));
      colduree.setCellValueFactory(new PropertyValueFactory<Formation,String>("duree"));
     colprix.setCellValueFactory(new PropertyValueFactory<Formation,Float>("prix"));;
             colevent.setCellValueFactory(new PropertyValueFactory<Formation,String>("event_id"));

affiche.setItems(l);
    }

    @FXML
    private void getSelectedFilm(MouseEvent event) {
    }

    @FXML
    private void selectOnAction(ActionEvent event) {
        Formation s = affiche .getSelectionModel().getSelectedItem();
     id.setText(String.valueOf(s.getId()));
      prix.setText(String.valueOf(s.getPrix()));
    nom.setText(s.getNom());
    type.setText(s.getType());
     duree.setText(s.getDuree());
    
    
    
    }
     private void refresh2()
    {      
        piechart.setData(piechartdata);
 
        
    }

    private Connection con;
    private ResultSet rs=null;
    private ResultSet rs1=null;
    private PreparedStatement pst,pst1;
    
     private void Stat(){
        
           ArrayList<Integer> np=new ArrayList<Integer>();
ArrayList<String> cat=new ArrayList<String>();
    Connection cnx=MaConnexion.getInstance().getCnx();

        piechartdata=FXCollections.observableArrayList();
    try {
       
        pst=cnx.prepareStatement("select * from event");
        rs=pst.executeQuery();
       
        while(rs.next() )
        {
           ;
             
            pst1=cnx.prepareStatement("select count(*) as countab FROM formation WHERE event_id="+rs.getInt("id"));
           rs1=pst1.executeQuery(); 
        while(rs1.next())
        {       
            int i=Integer.valueOf(rs1.getString("countab"));
            piechartdata.add(new PieChart.Data(rs.getString("title"),i));
            
            np.add(i);
            cat.add(rs.getString("title"));
        }
      
    }
    } catch (SQLException ex) {
        System.out.println("stat formation ");
    } 
     piechart.setData(piechartdata);
      }

    @FXML
    private void front(ActionEvent event) {
         FXMLLoader loader = new FXMLLoader(getClass().getResource("front.fxml"));
        try {
            Parent root = loader.load();
       FrontController apc = loader.getController();
           affiche.getScene().setRoot(root);
        } catch (IOException ex) {
            System.out.println(ex.getMessage());
        }
    }

    @FXML
    private void interfaceformation(ActionEvent event) throws IOException  { 
      
              Parent root = FXMLLoader.load(getClass().getResource("Formation.fxml"));
              Scene scene = new Scene(root);
              Stage stage = (Stage) ((Node) event.getSource()).getScene().getWindow();
              stage.setScene(scene);
              stage.show();
    }
  @FXML
    private void interfaceevent(ActionEvent event)throws IOException  {
        
          Parent root = FXMLLoader.load(getClass().getResource("FXMLDocument.fxml"));
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

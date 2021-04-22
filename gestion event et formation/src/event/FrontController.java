/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package event;

import Service.ServiceFormation;
import entites.Formation;
import java.io.IOException;
import java.net.URL;
import java.util.Optional;
import java.util.ResourceBundle;
import javafx.beans.value.ChangeListener;
import javafx.beans.value.ObservableValue;
import javafx.collections.FXCollections;
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
import javafx.scene.control.Label;
import javafx.scene.control.Slider;
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
public class FrontController implements Initializable {
private Float p=0f;

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
    private TextField tfSearch;
    @FXML
    private Button fermerbutton1;
    @FXML
    private Button tri;
    @FXML
    private AnchorPane front;
    @FXML
    private Slider slider;
    @FXML
    private TextField pmin;
    @FXML
    private TextField pmax;
    @FXML
    private Button goh;
    @FXML
    private Button goE;
    @FXML
    private Button gotoF;

   public void affiche1(){ 
        
  
 ObservableList<Formation> l = (ObservableList<Formation>) new ServiceFormation (). getAllP(p);        
     
          colnom.setCellValueFactory(new PropertyValueFactory<Formation,String>("nom"));
      coltype.setCellValueFactory(new PropertyValueFactory<Formation, String>("type"));
      colduree.setCellValueFactory(new PropertyValueFactory<Formation,String>("duree"));
     colprix.setCellValueFactory(new PropertyValueFactory<Formation,Float>("prix"));;
             colevent.setCellValueFactory(new PropertyValueFactory<Formation,String>("event_id"));

affiche.setItems(l);
    }
 
    @Override
    public void initialize(URL url, ResourceBundle rb) {
         ServiceFormation formation = new ServiceFormation();
         
      
    ObservableList<Formation> l = (ObservableList<Formation>) new ServiceFormation ().getAll();        
     
          colnom.setCellValueFactory(new PropertyValueFactory<Formation,String>("nom"));
      coltype.setCellValueFactory(new PropertyValueFactory<Formation, String>("type"));
      colduree.setCellValueFactory(new PropertyValueFactory<Formation,String>("duree"));
     colprix.setCellValueFactory(new PropertyValueFactory<Formation,Float>("prix"));;
             colevent.setCellValueFactory(new PropertyValueFactory<Formation,String>("event_id"));

affiche.setItems(l);
pmax.setText(String.valueOf(formation.getMax())+" DNT");
        pmax.setDisable(true);
        pmin.setDisable(true);
       slider.valueProperty().addListener(new ChangeListener<Number>(){
           @Override
           public void changed(ObservableValue<? extends Number> observable, Number oldValue, Number newValue) {
              p=(float) slider.getValue();
              pmin.setText(String.valueOf(p)+" DNT");
          affiche1();
           }

             

          
       });
   
       slider.setMax(formation.getMax());
        
    }    

    @FXML
    private void getSelectedFilm(MouseEvent event) {
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

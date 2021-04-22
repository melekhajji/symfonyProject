/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package event;

import java.io.IOException;
import java.net.URL;
import java.util.Optional;
import java.util.ResourceBundle;
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
import javafx.scene.layout.AnchorPane;
import javafx.stage.Stage;

/**
 * FXML Controller class
 *
 * @author HP
 */
public class FrontGController implements Initializable {

    @FXML
    private AnchorPane panemenu2;
    @FXML
    private Button fermerbutton2;
    @FXML
    private Button goE;
    @FXML
    private Button gotoF;
    @FXML
    private Button goh;

    /**
     * Initializes the controller class.
     */
    @Override
    public void initialize(URL url, ResourceBundle rb) {
        // TODO
    }    

    @FXML
    private void fermer(ActionEvent event) {
                  Alert alert =new Alert (Alert.AlertType.CONFIRMATION);
                alert.setTitle("Confirmation") ;
                alert.setHeaderText("Voulez vous fermer la fenêtre?") ;
                Optional <ButtonType> result=alert.showAndWait();
                if (result.get()==ButtonType.OK)
                {
                    Stage stage =(Stage) fermerbutton2.getScene().getWindow() ;
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

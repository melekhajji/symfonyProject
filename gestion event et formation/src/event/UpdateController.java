/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package event;

import java.io.File;
import java.net.URL;
import java.nio.file.Files;
import java.util.ResourceBundle;
import javafx.event.ActionEvent;
import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.scene.Node;
import javafx.scene.control.Button;
import javafx.scene.control.TextArea;
import javafx.scene.control.TextField;
import javafx.stage.Stage;
import tools.MaConnexion;
import java.sql.* ;
import javafx.event.EventHandler;
import javafx.geometry.Pos;
import javafx.scene.control.DatePicker;
import javafx.stage.FileChooser;
import org.controlsfx.control.Notifications;
        
        /**
 * FXML Controller class
 *
 * @author HP
 */
public class UpdateController implements Initializable {

    @FXML
    private TextField lieu;
    @FXML
    private DatePicker start;
    @FXML
    private TextField title;
    @FXML
    private TextField capacite;
    @FXML
    private DatePicker end;
    @FXML
    private TextArea desc;
    @FXML
    private Button image;
int id ;
    /**
     * Initializes the controller class.
     */
    @Override
    public void initialize(URL url, ResourceBundle rb) {
        
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
    private void Update(ActionEvent event) throws SQLException {
        
   String requette =  "UPDATE event SET `start`=?, `lieu`=?, `image`=?, `title`=? ,`end`=?, `description`=?,`capacite`=? where `id`= "+id ;

    Connection cn = MaConnexion.getInstance().getCnx();
    PreparedStatement ps = cn.prepareStatement(requette);
   
    ps.setDate(1,Date.valueOf(start.getValue()));
    ps.setString(2 , lieu.getText() );
    ps.setString(3 , image.getText() );
    ps.setString(4 , title.getText() );
  ps.setDate(5,Date.valueOf(end.getValue()));
    ps.setString(6 , desc.getText() );
    ps.setString(7 , capacite.getText() );
   
   

    ps.executeUpdate();
    System.out.println("Modifier avec succees !");
    
    
    Stage stage = (Stage) ((Node) event.getSource()).getScene().getWindow();
    stage.close();
    Notifications notificationBuild = Notifications.create()
                                      .title("Traitement Event")
                                      .text("Modifier avec succees")
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
    
    }
    
    


    void fonction(int id, Date end, String image, String capacite, String lieu, Date start, String title, String description) {
        this.id=id;
        this.lieu.setText(lieu);
    this.start.setValue(start.toLocalDate());
        this.title.setText(title);
        this.capacite.setText(capacite);
        this.end.setValue(end.toLocalDate());
        this.desc.setText(description);
        this.image.setText(image);

    }

    }
    
    


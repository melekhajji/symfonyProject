/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package javafxproject;

import Models.Question;
import Models.Quiz;
import Models.Reponse;
import Services.QuestionService;
import Services.QuizService;
import Services.ReponseService;
import Utils.DBConnect;
import java.net.URL;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ResourceBundle;
import javafx.event.ActionEvent;
import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.scene.control.Alert;
import javafx.scene.control.TableColumn;
import javafx.scene.control.TableView;
import javafx.scene.control.TextField;
import javafx.scene.control.cell.PropertyValueFactory;
import javafx.scene.input.MouseEvent;

/**
 * FXML Controller class
 *
 * @author Eya
 */
public class QuizController implements Initializable {

    @FXML
    private TableView<Quiz> tablequiz;
    @FXML
    private TableColumn<Quiz, String> Idquiz;
    @FXML
    private TableColumn<Quiz, String> Themequiz;
    @FXML
    private TableColumn<Quiz, String> Dureequiz;
    @FXML
    private TableColumn<Quiz, String> NbQuestionquiz;
    @FXML
    private TextField ThemeText;
    @FXML
    private TextField dureeText;
    @FXML
    private TextField nbquestionText;
    @FXML

    private TableView<Question> tablequestion;
    @FXML
    private TableColumn<Question, String> idquestion;
    @FXML
    private TableColumn<Question, String> enoncequestion;
    @FXML
    private TableColumn<Question, String> choix1question;
    @FXML
    private TableColumn<Question, String> choix2question;
    @FXML
    private TableColumn<Question, String> choix3question;
    @FXML
    private TableColumn<Question, String> IDquiz;
    @FXML
    private TextField enonceText;
    @FXML
    private TextField choix1Text;
    @FXML
    private TextField choix2Text;
    @FXML
    private TextField choix3Text;
    @FXML
    private TextField idquizText;
    @FXML
    private TableView<Reponse> tableReponse;
    @FXML
    private TableColumn<Reponse, String > idreponse;
    @FXML
    private TableColumn<Reponse, String> libellereponse;
    @FXML
    private TableColumn<Reponse, String> ID_question;
    @FXML
    private TextField libelleText;
    @FXML
    private TextField idquestionText;

    String query = null;
    Connection connection = null ;
    PreparedStatement preparedStatement = null ;
    ResultSet resultSet = null ;
    Quiz quiz = null;
    Question question = null;
    Reponse reponse = null;
    QuizService QuizS = new QuizService();
    QuestionService QuestionS = new QuestionService();
    ReponseService RepService = new ReponseService();
    /**
     * Initializes the controller class.
     */
    @Override
    public void initialize(URL url, ResourceBundle rb) {
        AfficherQuiz();
        AfficherQuestion() ;
        AfficherReponse() ;
    }    
    
    public void AfficherQuiz(){
        tablequiz.setItems(QuizS.Afficher());
        Idquiz.setCellValueFactory(new PropertyValueFactory<>("id"));
        Themequiz.setCellValueFactory(new PropertyValueFactory<>("theme"));
        Dureequiz.setCellValueFactory(new PropertyValueFactory<>("duree"));
        NbQuestionquiz.setCellValueFactory(new PropertyValueFactory<>("nbquestion"));
        
    }
     public void AfficherQuestion(){
        tablequestion.setItems(QuestionS.Afficher());
        idquestion.setCellValueFactory(new PropertyValueFactory<>("id"));
        enoncequestion.setCellValueFactory(new PropertyValueFactory<>("enonce"));
        choix1question.setCellValueFactory(new PropertyValueFactory<>("choix1"));
        choix2question.setCellValueFactory(new PropertyValueFactory<>("choix2"));
        choix3question.setCellValueFactory(new PropertyValueFactory<>("choix3"));
        IDquiz.setCellValueFactory(new PropertyValueFactory<>("id_quiz"));
        
    }

      public void AfficherReponse(){
        tableReponse.setItems(RepService.Afficher());
        idreponse.setCellValueFactory(new PropertyValueFactory<>("id"));
        libellereponse.setCellValueFactory(new PropertyValueFactory<>("libelle"));
       ID_question.setCellValueFactory(new PropertyValueFactory<>("id_question"));
       
    }
      
    @FXML
    private void recupererquiz(MouseEvent event) {
         quiz = tablequiz.getSelectionModel().getSelectedItem();
        ThemeText.setText(quiz.getTheme());
        dureeText.setText(String.valueOf(quiz.getDuree()));
        
        nbquestionText.setText(String.valueOf(quiz.getNbquestion()));
    }

    @FXML
    private void Ajouterquiz(ActionEvent event) {
        connection = DBConnect.getConnect();
        String theme = ThemeText.getText();
        int duree = Integer.parseInt(dureeText.getText());
        int nbquestion = Integer.parseInt(nbquestionText.getText());

        if (theme.isEmpty()) {
            Alert alert = new Alert(Alert.AlertType.ERROR);
            alert.setHeaderText(null);
            alert.setContentText("Please Fill All DATA");
            alert.showAndWait();

        } else {
            QuizS.Ajouter(theme,duree,nbquestion);
               AfficherQuiz();
        }
    }

    @FXML
    private void Modifierquiz(ActionEvent event) {
        quiz = tablequiz.getSelectionModel().getSelectedItem();
        String theme = ThemeText.getText();
        int duree = Integer.parseInt(dureeText.getText());
        int nbquestion = Integer.parseInt(nbquestionText.getText());
        QuizS.modifier(quiz.getId(), theme, duree, nbquestion);
        AfficherQuiz();
        cleanquiz();
    }

    @FXML
    private void Supprimerquiz(ActionEvent event) {
        try {
                                quiz = tablequiz.getSelectionModel().getSelectedItem();
                                QuizS.Supprimer(quiz.getId());
                                AfficherQuiz();
                                
                            } catch (SQLException ex) {
                            }
    }

    @FXML
    private void recupererquestion(MouseEvent event) {
         question = tablequestion.getSelectionModel().getSelectedItem();
        enonceText.setText(question.getEnonce());
        choix1Text.setText(question.getChoix1());
         choix2Text.setText(question.getChoix2());
          choix3Text.setText(question.getChoix3());
       idquizText.setText(String.valueOf(question.getId_quiz()));
       
    }

    @FXML
    private void Ajouterquestion(ActionEvent event) {
        connection = DBConnect.getConnect();
        String enonce = enonceText.getText();
        String choix1 = choix1Text.getText();
        String choix2 = choix2Text.getText();
        String choix3 = choix3Text.getText();
        int id_quiz = Integer.parseInt(idquizText.getText());
        

        if (enonce.isEmpty()) {
            Alert alert = new Alert(Alert.AlertType.ERROR);
            alert.setHeaderText(null);
            alert.setContentText("Please Fill All DATA");
            alert.showAndWait();

        } else {
            QuestionS.Ajouter(enonce,choix1,choix2,choix3,id_quiz);
            System.out.println(enonce+choix1+choix2+choix3+id_quiz);
            
               AfficherQuestion();
        }
    }
    

    @FXML
    private void Modifierquestion(ActionEvent event) {
        question = tablequestion.getSelectionModel().getSelectedItem();
        String enonce = enonceText.getText();
        String choix1  = choix1Text.getText();
        String choix2  = choix2Text.getText();
        String choix3  = choix3Text.getText();
        int id_quiz = Integer.parseInt(idquizText.getText());
       
        QuestionS.modifier(question.getId(), enonce, choix1, choix2 ,choix3,id_quiz);
        AfficherQuestion();
        cleanQuestion();
    }

    @FXML
    private void Supprimerquestion(ActionEvent event) {
        try {
                                question = tablequestion.getSelectionModel().getSelectedItem();
                                QuestionS.Supprimer(question.getId());
                                AfficherQuestion();
                                
                            } catch (SQLException ex) {
                            }
    }

    @FXML
    private void recupererreponse(MouseEvent event) {
        reponse = tableReponse.getSelectionModel().getSelectedItem();
        libelleText.setText(reponse.getLibelle());
        idquestionText.setText(String.valueOf(reponse.getId_question()));
    }

    @FXML
    private void Ajouterreponse(ActionEvent event) {
        connection = DBConnect.getConnect();
        String libelle = libelleText.getText();
      
        int id_question = Integer.parseInt(idquestionText.getText());
        

        if (libelle.isEmpty()) {
            Alert alert = new Alert(Alert.AlertType.ERROR);
            alert.setHeaderText(null);
            alert.setContentText("Please Fill All DATA");
            alert.showAndWait();

        } else {
            RepService.Ajouter(libelle,id_question);
               AfficherReponse();
        }
    }

    @FXML
    private void Modifierreponse(ActionEvent event) {
       reponse = tableReponse.getSelectionModel().getSelectedItem();
        String libelle = libelleText.getText();
      
        int id_question = Integer.parseInt(idquestionText.getText());
        RepService.modifier(reponse.getId(), libelle, id_question);
        AfficherReponse();
        cleanReponse();
    }

    private void cleanquiz() {
        ThemeText.setText(null);
        dureeText.setText(null);
        nbquestionText.setText(null);
    }
    
    private void cleanReponse() {
        libelleText.setText(null);
        ID_question.setText(null);
        
    }
     private void cleanQuestion() {
       enonceText.setText(null);
        choix1Text.setText(null);
        choix2Text.setText(null);
        choix3Text.setText(null);
       idquizText.setText(null);
        
    }
    @FXML
    private void Supprimerreponse(ActionEvent event) {
    
    try {
                                reponse = tableReponse.getSelectionModel().getSelectedItem();
                                RepService.Supprimer(reponse.getId());
                                AfficherReponse();
                                
                            } catch (SQLException ex) {
                            }
}
}
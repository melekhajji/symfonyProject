/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package javafxproject;

import Models.Question;
import Models.Quiz;

import Services.QuestionService;
import Services.QuizService;

import Utils.DBConnect;
import Utils.JavaMail;


import com.jfoenix.controls.JFXTextField;
import java.net.URL;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ResourceBundle;
import java.util.logging.Level;
import java.util.logging.Logger;
import javafx.event.ActionEvent;
import javafx.fxml.FXML;

import java.io.FileNotFoundException;
import java.io.FileOutputStream;
 
import com.itextpdf.text.Document;
import com.itextpdf.text.DocumentException;
import com.itextpdf.text.Paragraph;
import com.itextpdf.text.pdf.PdfPTable;
import com.itextpdf.text.pdf.PdfWriter;
import java.awt.Desktop;
import java.io.File;
import java.io.IOException;
import java.time.Duration;
import javafx.collections.ObservableList;
import javafx.event.EventHandler;
import javafx.fxml.Initializable;
import javafx.geometry.Pos;
import javafx.scene.control.Alert;
import javafx.scene.control.Button;
import javafx.scene.control.DatePicker;
import javafx.scene.control.Label;
import javafx.scene.control.TableColumn;
import javafx.scene.control.TableView;
import javafx.scene.control.TextField;
import javafx.scene.control.cell.PropertyValueFactory;
import javafx.scene.input.InputMethodEvent;
import javafx.scene.input.KeyEvent;
import javafx.scene.input.MouseEvent;
import javax.mail.MessagingException;
import javax.swing.JFileChooser;
import org.apache.poi.xssf.usermodel.XSSFRow;
import org.apache.poi.xssf.usermodel.XSSFSheet;
import org.apache.poi.xssf.usermodel.XSSFWorkbook;
import org.controlsfx.control.Notifications;

/**
 * FXML Controller class
 *
 * @author Eya
 */
public class QuizController implements Initializable {

    private Desktop desktop = Desktop.getDesktop();
    private Label label;
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
    private TextField rechercheTextQuiz ;
    
 @FXML
    private TextField duree1 ;
 @FXML
    private TextField duree2 ;
 
            
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
    private TableColumn<Question, String> reponsequestion;
     
     
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
    private TextField reponseText;
    @FXML
    private Button export;
   
                   
     private void handleButtonAction(ActionEvent event) {
        System.out.println("You clicked me!");
        label.setText("Hello World!");
    }
    
     
     
     

    String query = null;
    Connection connection = null ;
    PreparedStatement preparedStatement = null ;
    ResultSet resultSet = null ;
    Quiz quiz = null;
    Question question = null;
  
    QuizService QuizS = new QuizService();
    QuestionService QuestionS = new QuestionService();

    /**
     * Initializes the controller class.
     */
    @Override
    public void initialize(URL url, ResourceBundle rb) {
        AfficherQuiz();
        AfficherQuestion() ;
       
    }    
    
    public void AfficherQuiz(){
        tablequiz.setItems(QuizS.Afficher());
        Idquiz.setCellValueFactory(new PropertyValueFactory<>("id"));
        Themequiz.setCellValueFactory(new PropertyValueFactory<>("theme"));
        Dureequiz.setCellValueFactory(new PropertyValueFactory<>("duree"));
        NbQuestionquiz.setCellValueFactory(new PropertyValueFactory<>("nbquestion"));
        
    }
    
    @FXML
    private void RechercheQuiz(KeyEvent event) {
        System.out.println(rechercheTextQuiz.getText());
        tablequiz.setItems(QuizS.Recherche(rechercheTextQuiz.getText()));
      
        Idquiz.setCellValueFactory(new PropertyValueFactory<>("id"));
        Themequiz.setCellValueFactory(new PropertyValueFactory<>("theme"));
        Dureequiz.setCellValueFactory(new PropertyValueFactory<>("duree"));
        NbQuestionquiz.setCellValueFactory(new PropertyValueFactory<>("nbquestion"));
        
    }
    
    
    @FXML
    private void FiltreRecherche(KeyEvent event) {
        
        String duree11 = String.valueOf(duree1.getText());
        String duree22 = String.valueOf(duree2.getText());
        if(!duree11.isEmpty() || !duree22.isEmpty()){
        tablequiz.setItems(QuizS.Filtrer(duree11, duree22));
    
           Idquiz.setCellValueFactory(new PropertyValueFactory<>("id"));
        Themequiz.setCellValueFactory(new PropertyValueFactory<>("theme"));
        Dureequiz.setCellValueFactory(new PropertyValueFactory<>("duree"));
        NbQuestionquiz.setCellValueFactory(new PropertyValueFactory<>("nbquestion"));
        
    }}
    @FXML
    private void TrieParNq(ActionEvent event) {
        tablequiz.setItems(QuizS.Trienq());
        Idquiz.setCellValueFactory(new PropertyValueFactory<>("id"));
        Themequiz.setCellValueFactory(new PropertyValueFactory<>("theme"));
        Dureequiz.setCellValueFactory(new PropertyValueFactory<>("duree"));
        NbQuestionquiz.setCellValueFactory(new PropertyValueFactory<>("nbquestion")); }
     @FXML
    private void TrieParduree(ActionEvent event) {
        tablequiz.setItems(QuizS.Trieduree());
        Idquiz.setCellValueFactory(new PropertyValueFactory<>("id"));
        Themequiz.setCellValueFactory(new PropertyValueFactory<>("theme"));
        Dureequiz.setCellValueFactory(new PropertyValueFactory<>("duree"));
        NbQuestionquiz.setCellValueFactory(new PropertyValueFactory<>("nbquestion")); }
    
    
    
    
    
    
    
    
    
     public void AfficherQuestion(){
        tablequestion.setItems(QuestionS.Afficher());
        idquestion.setCellValueFactory(new PropertyValueFactory<>("id"));
         IDquiz.setCellValueFactory(new PropertyValueFactory<>("quiz_id"));
        enoncequestion.setCellValueFactory(new PropertyValueFactory<>("enonce"));
        choix1question.setCellValueFactory(new PropertyValueFactory<>("choix1"));
        choix2question.setCellValueFactory(new PropertyValueFactory<>("choix2"));
        choix3question.setCellValueFactory(new PropertyValueFactory<>("choix3"));
        reponsequestion.setCellValueFactory(new PropertyValueFactory<>("reponse"));
       
        
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
          try {
            JavaMail.sendMail("eyayousfi102@gmail.com");
        } catch (MessagingException ex) {
            Logger.getLogger(FXMLDocumentController.class.getName()).log(Level.SEVERE, null, ex);
        }
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
         Notifications notificationBuild = Notifications.create()
                                      .title("Traitement quiz")
                                      .text("Quiz modifié avec succès")
                                      .graphic(null)
                                     
                                      .position(Pos.CENTER)
                                      .onAction(new EventHandler<ActionEvent>() {
                                  @Override
                                  public void handle(ActionEvent event) {
                                      System.out.println("click here");
                                  }
                                  
                              });
                              notificationBuild.show();
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
          idquizText.setText(String.valueOf(question.getQuiz_id()));
          enonceText.setText(question.getEnonce());
          choix1Text.setText(question.getChoix1());
          choix2Text.setText(question.getChoix2());
          choix3Text.setText(question.getChoix3());
          reponseText.setText(question.getReponse());
       
    }

    @FXML
    private void Ajouterquestion(ActionEvent event) {
        connection = DBConnect.getConnect();
         int quiz_id = Integer.parseInt(idquizText.getText());
        String enonce = enonceText.getText();
        String choix1 = choix1Text.getText();
        String choix2 = choix2Text.getText();
        String choix3 = choix3Text.getText();
       String reponse = reponseText.getText();
        

        if (enonce.isEmpty()) {
            Alert alert = new Alert(Alert.AlertType.ERROR);
            alert.setHeaderText(null);
            alert.setContentText("Please Fill All DATA");
            alert.showAndWait();

        } else {
            QuestionS.Ajouter(quiz_id ,enonce,choix1,choix2,choix3,reponse);
            System.out.println(quiz_id+enonce+choix1+choix2+choix3+reponse);
            
               AfficherQuestion();
        }
    }
    

    @FXML
    private void Modifierquestion(ActionEvent event) {
        question = tablequestion.getSelectionModel().getSelectedItem();
        int quiz_id = Integer.parseInt(idquizText.getText());
        String enonce = enonceText.getText();
        String choix1  = choix1Text.getText();
        String choix2  = choix2Text.getText();
        String choix3  = choix3Text.getText();
        String reponse  = reponseText.getText();
       
        QuestionS.modifier(question.getId(),quiz_id ,enonce, choix1, choix2 ,choix3, reponse);
        
        
        Notifications notificationBuild = Notifications.create()
                                      .title("Traitement Questions")
                                      .text("Question modifié avec succès")
                                      .graphic(null)
                                     
                                      .position(Pos.CENTER)
                                      .onAction(new EventHandler<ActionEvent>() {
                                  @Override
                                  public void handle(ActionEvent event) {
                                      System.out.println("click here");
                                  }
                                  
                              });
                              notificationBuild.show();
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

   
  

   

    private void cleanquiz() {
        ThemeText.setText(null);
        dureeText.setText(null);
        nbquestionText.setText(null);
    }
    
   
     private void cleanQuestion() {
           idquizText.setText(null);
           enonceText.setText(null);
           choix1Text.setText(null);
           choix2Text.setText(null);
           choix3Text.setText(null);
           reponseText.setText(null);
        
    }
   
     @FXML
    private void Imprimer(ActionEvent event) throws IOException {
        String path="";
        
        Document document = new Document();
      try
      {
         PdfWriter writer = PdfWriter.getInstance(document, new FileOutputStream(path+"QUIZ.pdf"));
           document.open();
          PdfPTable tb1 = new PdfPTable(7);
          tb1.addCell("Identifiant");
          tb1.addCell("IdQuiz");
          tb1.addCell("enonce");
          tb1.addCell("choix1");
          tb1.addCell("choix2");
          tb1.addCell("choix3");
          tb1.addCell("reponse");
          ObservableList<Question> ques = QuestionS.Afficher();
          for (int i = 0; i < ques.size(); i++) {
              String id= String.valueOf(ques.get(i).getId());
              String idQuiz= String.valueOf(ques.get(i).getQuiz_id());
              String enonce= String.valueOf(ques.get(i).getEnonce());
              String choix1= String.valueOf(ques.get(i).getChoix1());
               String choix2= String.valueOf(ques.get(i).getChoix2());
                String choix3= String.valueOf(ques.get(i).getChoix3());
              String reponse= String.valueOf(ques.get(i).getReponse());
              
          tb1.addCell(id);
          tb1.addCell(idQuiz);
          tb1.addCell(enonce);
          tb1.addCell(choix1);
          tb1.addCell(choix2);
          tb1.addCell(choix3);
          tb1.addCell(reponse);
          }
         document.add(new Paragraph("QUESTIONS"));
         document.add(tb1);
         document.close();
         writer.close();
        File file=new File("QUIZ.pdf");
         desktop.open(file);
          System.out.println("javafxapplication1.FXMLDocumentController.Imprimer()");
      } catch (DocumentException e)
      {
         e.printStackTrace();
      } catch (FileNotFoundException e)
      {
         e.printStackTrace();
      }
    }
     
    
    
      @FXML
    public void exportExcel() {
        try {
            String requete = "Select * from quiz ";
            PreparedStatement pst = connection.prepareStatement(requete);
            resultSet = pst.executeQuery(requete);
            XSSFWorkbook wb = new XSSFWorkbook();
            XSSFSheet sheet = wb.createSheet("quiz details");
            XSSFRow header = sheet.createRow(0);
            header.createCell(0).setCellValue("id");
            header.createCell(1).setCellValue("theme");
            header.createCell(2).setCellValue("duree");
            header.createCell(3).setCellValue("nbquestion");
            

            sheet.autoSizeColumn(2);
            sheet.setColumnWidth(1, 110 * 25);
            sheet.setColumnWidth(2, 256 * 25);
            sheet.setColumnWidth(4, 256 * 25);
            sheet.setColumnWidth(5, 256 * 25);
            sheet.setColumnWidth(6, 256 * 25);

            sheet.setZoom(150);
            int index = 1;
            while (resultSet.next()) {
                XSSFRow row = sheet.createRow(index);
                row.createCell(0).setCellValue(resultSet.getString("id"));
                // row.createCell(1).setCellValue(resultSet.getString("image"));
                row.createCell(1).setCellValue(resultSet.getString("theme"));
                row.createCell(2).setCellValue(resultSet.getString("duree"));
                row.createCell(3).setCellValue(resultSet.getString("nbquestion"));
                
            }
            try (FileOutputStream fileOut = new FileOutputStream("ListedesQuestion.xlsx")) {
                wb.write(fileOut);
                fileOut.close();
                Alert alert = new Alert(Alert.AlertType.INFORMATION);
                alert.setTitle("succés");
                alert.setHeaderText("Quiz exporté en excel");
                alert.setContentText("");
                alert.showAndWait();

                pst.close();
                resultSet.close();
            }

        } catch (SQLException | FileNotFoundException ex) {
            Logger.getLogger(QuizController.class.getName()).log(Level.SEVERE, null, ex);
        } catch (IOException ex) {
            Logger.getLogger(QuizController.class.getName()).log(Level.SEVERE, null, ex);
        }

    }
    
    
    
    }
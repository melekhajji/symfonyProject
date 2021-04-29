/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package Models;

/**
 *
 * @author Eya
 */
public class Question {
    private int id ;
     private int quiz_id ;
     private String enonce;
     private String choix1 ;
      private String choix2 ;
      private String choix3 ;
       private String reponse ;
       

    public Question(int id, int quiz_id ,String enonce, String choix1, String choix2, String choix3,  String reponse) {
        this.id = id;
         this.quiz_id = quiz_id;
        this.enonce = enonce;
       
        this.choix1 = choix1;
        this.choix2 = choix2;
        this.choix3 = choix3;
        this.reponse = reponse;
    }

    public int getId() {
        return id;
    }

  

    public String getEnonce() {
        return enonce;
    }

    public void setEnonce(String enonce) {
        this.enonce = enonce;
    }

    public String getChoix1() {
        return choix1;
    }

    public void setChoix1(String choix1) {
        this.choix1 = choix1;
    }

    public String getChoix2() {
        return choix2;
    }

    public void setChoix2(String choix2) {
        this.choix2 = choix2;
    }

    public String getChoix3() {
        return choix3;
    }

    public void setChoix3(String choix3) {
        this.choix3 = choix3;
    }

    public int getQuiz_id() {
        return quiz_id;
    }

    public void setQuiz_id(int quiz_id) {
        this.quiz_id = quiz_id;
    }

    public String getReponse() {
        return reponse;
    }

    public void setReponse(String reponse) {
        this.reponse = reponse;
    }

  
       
       
    
}

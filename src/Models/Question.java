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
     private String enonce;
    private String choix1 ;
     private String choix2 ;
      private String choix3 ;
       private int id_quiz ;

    public Question(int id, String enonce, String choix1, String choix2, String choix3, int id_quiz) {
        this.id = id;
        this.enonce = enonce;
        this.choix1 = choix1;
        this.choix2 = choix2;
        this.choix3 = choix3;
        this.id_quiz = id_quiz;
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

    public int getId_quiz() {
        return id_quiz;
    }

    public void setId_quiz(int id_quiz) {
        this.id_quiz = id_quiz;
    }
       
       
    
}

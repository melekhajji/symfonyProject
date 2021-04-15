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
public class Reponse {
     private int id ;
      private String libelle ;
       private int id_question ;

    public Reponse(int id, String libelle, int id_question) {
        this.id = id;
        this.libelle = libelle;
        this.id_question = id_question;
    }

    public int getId() {
        return id;
    }

   

    public String getLibelle() {
        return libelle;
    }

    public void setLibelle(String libelle) {
        this.libelle = libelle;
    }

    public int getId_question() {
        return id_question;
    }

    public void setId_question(int id_question) {
        this.id_question = id_question;
    }
    
    
}

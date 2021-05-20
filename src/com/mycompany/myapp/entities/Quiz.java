/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.mycompany.myapp.entities;

/**
 *
 * @author bhk
 */
public class Quiz {
    private int id ;
    private String theme ;
    private  int duree ;
    private  int nbquestion ;
    public void setId(int id) {
        this.id = id;
    }

    public Quiz() {
    }

    public Quiz(String theme, int duree, int nbquestion) {
        this.theme = theme;
        this.duree = duree;
        this.nbquestion = nbquestion;
    }

    public Quiz(int id, String theme, int duree, int nbquestion) {
        this.id = id;
        this.theme = theme;
        this.duree = duree;
        this.nbquestion = nbquestion;
    }

    public int getId() {
        return id;
    }

    public String getTheme() {
        return theme;
    }

    public void setTheme(String theme) {
        this.theme = theme;
    }

    public int getDuree() {
        return duree;
    }

    public void setDuree(int duree) {
        this.duree = duree;
    }

    public int getNbquestion() {
        return nbquestion;
    }

    public void setNbquestion(int nbquestion) {
        this.nbquestion = nbquestion;
    }
    
    
    
    
}

     
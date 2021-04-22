/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package entites;

import java.sql.Date;

/**
 *
 * @author HP
 */
public class Event {
     private int id;
    private Date start;

   
    private String lieu;
private String image;
 private String title;
           private Date end;
            private String description;
            
            
               private String capacite;

    public Event(Date start, String lieu, String image, String title, Date end, String description, String capacite) {
        this.start = start;
        this.lieu = lieu;
        this.image = image;
        this.title = title;
        this.end = end;
        this.description = description;
        this.capacite = capacite;
    }

    public Event(int id, Date start, String lieu, String image, String title, Date end, String description, String capacite) {
        this.id = id;
        this.start = start;
        this.lieu = lieu;
        this.image = image;
        this.title = title;
        this.end = end;
        this.description = description;
        this.capacite = capacite;
    }

    public Event() {
    }

   

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

   

    public String getLieu() {
        return lieu;
    }

    public void setLieu(String lieu) {
        this.lieu = lieu;
    }

    public String getImage() {
        return image;
    }

    public void setImage(String image) {
        this.image = image;
    }

    public String getTitle() {
        return title;
    }

    public void setTitle(String title) {
        this.title = title;
    }

    

    public String getDescription() {
        return description;
    }

    public void setDescription(String description) {
        this.description = description;
    }

    public String getCapacite() {
        return capacite;
    }

    public void setCapacite(String capacite) {
        this.capacite = capacite;
    }

    public Date getStart() {
        return start;
    }

    public void setStart(Date start) {
        this.start = start;
    }

    public Date getEnd() {
        return end;
    }

    public void setEnd(Date end) {
        this.end = end;
    }
    
}

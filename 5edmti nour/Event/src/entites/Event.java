/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package entites;

/**
 *
 * @author HP
 */
public class Event {
     private int id;
    private String start;

   
    private String lieu;
private String image;
 private String title;
           private String end;
            private String description;
            
            
               private int capacite;

    public Event(String start, String lieu, String image, String title, String end, String description, int capacite) {
        this.start = start;
        this.lieu = lieu;
        this.image = image;
        this.title = title;
        this.end = end;
        this.description = description;
        this.capacite = capacite;
    }

    public Event(int id, String start, String lieu, String image, String title, String end, String description, int capacite) {
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

    public String getStart() {
        return start;
    }

    public void setStart(String start) {
        this.start = start;
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

    public String getEnd() {
        return end;
    }

    public void setEnd(String end) {
        this.end = end;
    }

    public String getDescription() {
        return description;
    }

    public void setDescription(String description) {
        this.description = description;
    }

    public int getCapacite() {
        return capacite;
    }

    public void setCapacite(int capacite) {
        this.capacite = capacite;
    }
    
}

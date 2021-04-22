
package entites;


public class Formation {
   private int  id;
         private String    nom;

    public Formation(int id, String nom, String type, String duree, float prix) {
        this.id = id;
        this.nom = nom;
        this.type = type;
        this.duree = duree;
        this.prix = prix;
    }
         private String  type;
         
                  private String duree;
               private float    prix;
                           private String event_id;

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public String getNom() {
        return nom;
    }

    public Formation(String nom, String type, String duree, float prix) {
        this.nom = nom;
        this.type = type;
        this.duree = duree;
        this.prix = prix;
    }

    public void setNom(String nom) {
        this.nom = nom;
    }

    public String getType() {
        return type;
    }

    public void setType(String type) {
        this.type = type;
    }

    public String getDuree() {
        return duree;
    }

    public void setDuree(String duree) {
        this.duree = duree;
    }

    public float getPrix() {
        return prix;
    }

    public void setPrix(float prix) {
        this.prix = prix;
    }

    public Formation(int id, String nom, String type, String duree, float prix, String event_id) {
        this.id = id;
        this.nom = nom;
        this.type = type;
        this.duree = duree;
        this.prix = prix;
        this.event_id = event_id;
    }

    public Formation() {
    }

    public Formation(String nom, String type, String duree, float prix, String event_id) {
        this.nom = nom;
        this.type = type;
        this.duree = duree;
        this.prix = prix;
        this.event_id = event_id;
    }

  

    

    public String getEvent_id() {
        return event_id;
    }

    public void setEvent_id(String event_id) {
        this.event_id = event_id;
    }
                    
    
}

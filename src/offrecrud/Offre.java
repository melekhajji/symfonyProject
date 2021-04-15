/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package offrecrud;
import java.util.Date;

/**
 *
 * @author ASUS
 */
public class Offre {
    private Integer id;
    private String Titre;
    private String Entreprise;
    private String Adresse;
    private String Postes_Vacants;
    private String Type_Contrat;
    private String Experience;
    private String Remuneration;
    private String Langues;
    private String Description;
    private String Date_Expiration;

    public Offre(Integer id, String Titre, String Entreprise, String Adresse, String Postes_Vacants, String Type_Contrat, String Experience, String Remuneration, String Langues, String Description, String Date_Expiration) {
        this.id = id;
        this.Titre = Titre;
        this.Entreprise = Entreprise;
        this.Adresse = Adresse;
        this.Postes_Vacants = Postes_Vacants;
        this.Type_Contrat = Type_Contrat;
        this.Experience = Experience;
        this.Remuneration = Remuneration;
        this.Langues = Langues;
        this.Description = Description;
        this.Date_Expiration = Date_Expiration;
    }

   

    

    public Integer getId() {
        return id;
    }

    public String getTitre() {
        return Titre;
    }

    public String getEntreprise() {
        return Entreprise;
    }

    public String getAdresse() {
        return Adresse;
    }

    public String getPostes_Vacants() {
        return Postes_Vacants;
    }

    public String getType_Contrat() {
        return Type_Contrat;
    }

    public String getExperience() {
        return Experience;
    }

    public String getRemuneration() {
        return Remuneration;
    }

    public String getLangues() {
        return Langues;
    }

    public String getDescription() {
        return Description;
    }

    public String getDate_Expiration() {
        return Date_Expiration;
    }
    
}

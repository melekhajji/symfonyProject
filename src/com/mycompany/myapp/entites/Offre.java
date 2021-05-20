/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.mycompany.myapp.entites;



/**
 *
 * @author ASUS
 */
public class Offre {
    
    private int id;
    private String titre,entreprise,adresse,postes_vacants,type_contrat,experience,remuneration,langues,description,date_expiration;

    public Offre(String titre, String entreprise, String adresse, String postes_vacants, String type_contrat, String experience, String remuneration, String langues, String description, String date_expiration) {
        this.titre = titre;
        this.entreprise = entreprise;
        this.adresse = adresse;
        this.postes_vacants = postes_vacants;
        this.type_contrat = type_contrat;
        this.experience = experience;
        this.remuneration = remuneration;
        this.langues = langues;
        this.description = description;
        this.date_expiration = date_expiration;
    }

    public Offre(int id, String titre, String entreprise, String adresse, String postes_vacants, String type_contrat, String experience, String remuneration, String langues, String description, String date_expiration) {
        this.id = id;
        this.titre = titre;
        this.entreprise = entreprise;
        this.adresse = adresse;
        this.postes_vacants = postes_vacants;
        this.type_contrat = type_contrat;
        this.experience = experience;
        this.remuneration = remuneration;
        this.langues = langues;
        this.description = description;
        this.date_expiration = date_expiration;
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public String getTitre() {
        return titre;
    }

    public void setTitre(String titre) {
        this.titre = titre;
    }

    public String getEntreprise() {
        return entreprise;
    }

    public void setEntreprise(String entreprise) {
        this.entreprise = entreprise;
    }

    public String getAdresse() {
        return adresse;
    }

    public void setAdresse(String adresse) {
        this.adresse = adresse;
    }

    public String getPostes_vacants() {
        return postes_vacants;
    }

    public void setPostes_vacants(String postes_vacants) {
        this.postes_vacants = postes_vacants;
    }

    public String getType_contrat() {
        return type_contrat;
    }

    public void setType_contrat(String type_contrat) {
        this.type_contrat = type_contrat;
    }

    public String getExperience() {
        return experience;
    }

    public void setExperience(String experience) {
        this.experience = experience;
    }

    public String getRemuneration() {
        return remuneration;
    }

    public void setRemuneration(String remuneration) {
        this.remuneration = remuneration;
    }

    public String getLangues() {
        return langues;
    }

    public void setLangues(String langues) {
        this.langues = langues;
    }

    public String getDescription() {
        return description;
    }

    public void setDescription(String description) {
        this.description = description;
    }

    public String getDate_expiration() {
        return date_expiration;
    }

    public void setDate_expiration(String date_expiration) {
        this.date_expiration = date_expiration;
    }

    @Override
    public String toString() {
        return "Offre{" + "id=" + id + ", titre=" + titre + ", entreprise=" + entreprise + ", adresse=" + adresse + ", postes_vacants=" + postes_vacants + ", type_contrat=" + type_contrat + ", experience=" + experience + ", remuneration=" + remuneration + ", langues=" + langues + ", description=" + description + ", date_expiration=" + date_expiration + '}';
    }

    public Offre() {
    }
    
}
